@section('show-list-template')
<div class="table-responsive">
    @if(count($dataTypeContent) > 0)
        <div>
            <a href="javascript:void(0);" title="Edit All" class="btn btn-sm btn-primary pull-righ edit" v-if="!edit" @click="edit = !edit">
                <i class="voyager-edit"></i>
                <span class="hidden-xs hidden-sm">Edit All</span>
            </a>
            <a href="javascript:void(0);" title="Edit All" class="btn btn-sm btn-danger pull-righ edit" v-if="edit" @click="edit = !edit">
                <span class="hidden-xs hidden-sm">Cancel</span>
            </a>
            <a href="javascript:void(0);" title="Edit All" class="btn btn-sm btn-success pull-righ edit" v-if="edit" @click="stringifyTable">
                <span class="hidden-xs hidden-sm">Submit</span>
            </a>
        </div>
    @endif
        <table id="dataTable" class="table table-hover">
        <thead>
        <tr>
            @can('delete',app($dataType->model_name))
                <th></th>
            @endcan
            @foreach($dataType->browseRows as $row)
                <th>
                    @if ($isServerSide)
                        <a href="{{ $row->sortByUrl() }}">
                            @endif
                            {{ $row->display_name }}
                            @if ($isServerSide)
                                @if ($row->isCurrentSortField())
                                    @if (!isset($_GET['sort_order']) || $_GET['sort_order'] == 'asc')
                                        <i class="voyager-angle-up pull-right"></i>
                                    @else
                                        <i class="voyager-angle-down pull-right"></i>
                                    @endif
                                @endif
                        </a>
                    @endif
                </th>
            @endforeach
            <th class="actions">{{ __('voyager.generic.actions') }}</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in contentsCopy">
                <td>
                    <input type="checkbox" name="row_id" :id="'checkbox_' + item.id" :value="item.id">
                </td>

                @foreach($dataType->browseRows as $row)

                    <td>
                        @if(in_array($row->field, ['created_at', 'updated_at', 'id']))
                            <span v-text="item.{{ $row->field }}"></span>
                        @elseif($row->field == 'auto_d')
                            <div v-if="edit">
                                <label for="one"><input type="radio" id="one" value="left" v-model="item.{{ $row->field }}" :checked="item.{{ $row->field }} == 'left'">left</label>
                                <br>
                                <label for="two"><input type="radio" id="two" value="right" v-model="item.{{ $row->field }}" :checked="item.{{ $row->field }} == 'right'">right</label>
                            </div>
                            <div v-if="!edit">
                                <span v-text="item.{{ $row->field }}"></span>
                            </div>
                        @else
                            <div v-if="edit">
                               <input style="width:50px;" type="text"  v-model="item.{{ $row->field }}">
                            </div>
                            <div v-if="!edit">
                                <span v-text="item.{{ $row->field }}"></span>
                            </div>
                        @endif
                    </td>
                @endforeach

                <td class="no-sort no-click" id="bread-actions">
                    <a href="javascript:;" title="{{ __('voyager.generic.delete') }}" class="btn btn-sm btn-danger pull-right delete" :data-id="item.id" :id="'delete-' + item.id">
                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager.generic.delete') }}</span>
                    </a>
                    <a :href="'/admin/fly-settings/' + item.id + '/edit'" title="{{ __('voyager.generic.edit') }}" class="btn btn-sm btn-primary pull-right edit">
                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">{{ __('voyager.generic.edit') }}</span>
                    </a>
                    {{--<a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->{$data->getKeyName()}) }}" title="{{ __('voyager.generic.edit') }}" class="btn btn-sm btn-primary pull-right edit">--}}
                        {{--<i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">{{ __('voyager.generic.edit') }}</span>--}}
                    {{--</a>--}}
                    <a :href="'/admin/fly-settings/' + item.id" title="{{ __('voyager.generic.view') }}" class="btn btn-sm btn-warning pull-right">
                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">{{ __('voyager.generic.view') }}</span>
                    </a>
                    {{--<a href="{{ route('voyager.'.$dataType->slug.'.show', $data->{$data->getKeyName()}) }}" title="{{ __('voyager.generic.view') }}" class="btn btn-sm btn-warning pull-right">--}}
                        {{--<i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">{{ __('voyager.generic.view') }}</span>--}}
                    {{--</a>--}}
                </td>
            </tr>
        </tbody>
    </table>
    @if(count($dataTypeContent) > 0)
        <div>
            <a href="javascript:void(0);" title="Edit All" class="btn btn-sm btn-primary pull-righ edit" v-if="!edit" @click="edit = !edit">
                <i class="voyager-edit"></i>
                <span class="hidden-xs hidden-sm">Edit All</span>
            </a>
            <a href="javascript:void(0);" title="Edit All" class="btn btn-sm btn-danger pull-righ edit" v-if="edit" @click="edit = !edit">
                <span class="hidden-xs hidden-sm">Cancel</span>
            </a>
            <a href="javascript:void(0);" title="Edit All" class="btn btn-sm btn-success pull-righ edit" v-if="edit" @click="stringifyTable">
                <span class="hidden-xs hidden-sm">Submit</span>
            </a>
        </div>
    @endif
    <form
            ref="form"
            action="{{ route('voyager.fly-settings.multi.update') }}"
            @submit.prevent="stringifyTable"
            @keydown.enter.prevent
            method="POST"
            enctype="multipart/form-data"
    >
        {{ csrf_field() }}
        <input name="contents" v-model="tableJson" type="hidden">
    </form>
</div>

@endsection


<script>
    Vue.component('show-list-editor', {
        props: {
            table: {
                type: Array,
                default: []
            },
            edit: {
                type: Boolean,
                default: false
            },
        },
        template: `@yield('show-list-template')`,
        data () {
            return {
                contentsCopy: null,
                tableJson: null
            }
        },
        computed: {
        },
        methods: {
            initContent () {
                //this.table = JSON.parse(this.tableJson);
                this.contentsCopy = JSON.parse(this.table);
                console.log(this.contentsCopy)
            },
            getEditLink (answerId) {
                {{--let questionId = {!! $dataTypeContent->id !!}--}}
                    {{--return '/admin/questions/'+ this.questionId +'/answer/' + answerId + '/edit';--}}
            },
            getViewLink (id) {

            },
            stringifyTable() {
                this.edit = !this.edit;
                this.tableJson = JSON.stringify(this.contentsCopy);
                this.$nextTick(() => this.$refs.form.submit());
            },
        },
        created () {
            this.initContent();
        },
        watch: {
            contentsCopy: function () {
                //this.tableJson = JSON.stringify(this.contentsCopy);
                console.log(this.tableJson)
            }
        }
    });
</script>