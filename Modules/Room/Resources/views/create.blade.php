@extends ('backend.layouts.app')

@section ('title', trans('room::labels.backend.room.management') . ' | ' . trans('room::labels.backend.room.create'))

@section('page-header')
    <h1>
        {{ trans('room::labels.backend.room.management') }}
        <small>{{ trans('room::labels.backend.room.create') }}</small>
    </h1>
@endsection

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="/css/backend/plugin/bootstrap-summernote/summernote.css">
@endsection

@section('content')
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('room::labels.backend.room.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('room::partials.header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->
            <div class="box-body form">
                <?php 
                    if(old('tab')) $tab=old('tab');
                    elseif(isset($_GET['tab'])) $tab=$_GET['tab'];
                    else $tab='prices';
                ?>

                {{ Form::open(['route' => 'admin.room.store', 'class' => 'form-horizontal', 'files' => true ,'role' => 'form', 'method' => 'post', 'id' => 'create-room']) }}

                    {!! Form::hidden('tab',$tab) !!}
                    <div class="form-group">
                        {{ Form::label('status', trans('room::labels.backend.room.table.status'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            <select class='form-control select2' name='status' autofocus="true">    
                                <option value="1" selected>Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('name', trans('room::labels.backend.room.table.name'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.name')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('meta_keyword', trans('room::labels.backend.room.table.meta_keyword'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::textarea('meta_keyword', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.meta_keyword')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('meta_description', trans('room::labels.backend.room.table.meta_description'), ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.meta_description')]) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('hotel_id', trans('room::labels.backend.room.table.hotel_name'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            <select class='form-control select2' name='hotel_id'>
                                <option></option>
                                @foreach($hotels as $hotel)
                                    @if(old('hotel_id') == $hotel->id)
                                        <option value="{{ $hotel->id }}" selected>{{ $hotel->name }} ({{ $hotel->city->name }})</option>
                                    @else
                                        <option value="{{ $hotel->id }}"> {{ $hotel->name }} ({{ $hotel->city->name }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('room_category_id', trans('room::labels.backend.room.table.room_type'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            <select class='form-control select2' name='room_category_id'>
                                <option></option>
                                @foreach($room_categories as $room_category)
                                    @if(old('room_category_id') == $room_category->id)
                                        <option value="{{ $room_category->id }}" selected>{{ $room_category->name }}</option>
                                    @else
                                        <option value="{{ $room_category->id }}"> {{ $room_category->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('description', trans('room::labels.backend.room.table.description'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::textarea('description', null, ['class' => 'form-control editor', 'placeholder' => trans('room::labels.backend.room.table.description')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('quantity', trans('room::labels.backend.room.table.quantity'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.quantity')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('minimum_stay', trans('room::labels.backend.room.table.minimum_stay'), ['class' => 'col-lg-2 control-label']) }}
                        {{-- <label name='minimum_stay' class='col-lg-2 control-label'>{{trans('room::labels.backend.room.table.minimum_stay')}}<font size="3" color="red">*</font></label> --}}

                        <div class="col-lg-10">
                            {{ Form::text('minimum_stay', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.minimum_stay')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('max_adults', trans('room::labels.backend.room.table.max_adults'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('max_adults', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.max_adults')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('extra_bed', trans('room::labels.backend.room.table.extra_bed'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('extra_bed', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.extra_bed')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('extra_bed_charge', trans('room::labels.backend.room.table.extra_bed_charge'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            {{ Form::text('extra_bed_charge', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.extra_bed_charge')]) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <label for="option" class="col-lg-2 control-label tab_label">{{ ucfirst($tab) }}</label>
                    
                    <div class="col-md-6">
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading" style="padding: 5px 5px 0 5px;">
                                    <ul class="nav nav-tabs">
                                        <li class="{{ ($tab=='prices')?'active':'' }}"><a href="#prices" data-toggle="tab">Prices</a></li>
                                        <li class="{{ ($tab=='amenities')?'active':'' }}"><a href="#amenities" data-toggle="tab">Amenities</a></li>
                                        {{-- <li class="dropdown">
                                            <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                                                <li><a href="#tab5default" data-toggle="tab">Default 5</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane {{ ($tab=='prices')?'active':'' }}" id="prices">
                                        <div class="form-group">
                                            <br>
                                            {{ Form::label('local_buy_price', trans('room::labels.backend.room.table.local_buy_price'), ['class' => 'col-lg-2 control-label']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('local_buy_price', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.local_buy_price')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <div class="form-group">
                                            {{ Form::label('local_sell_price', trans('room::labels.backend.room.table.local_sell_price'), ['class' => 'col-lg-2 control-label']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('local_sell_price', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.local_sell_price')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <div class="form-group">
                                            {{ Form::label('foreign_buy_price', trans('room::labels.backend.room.table.foreign_buy_price'), ['class' => 'col-lg-2 control-label']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('foreign_buy_price', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.foreign_buy_price')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <div class="form-group">
                                            {{ Form::label('foreign_sell_price', trans('room::labels.backend.room.table.foreign_sell_price'), ['class' => 'col-lg-2 control-label']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('foreign_sell_price', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.foreign_sell_price')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <div class="form-group">
                                            {{ Form::label('agent_buy_price', trans('room::labels.backend.room.table.agent_buy_price'), ['class' => 'col-lg-2 control-label']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('agent_buy_price', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.agent_buy_price')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->

                                        <div class="form-group">
                                            {{ Form::label('agent_sell_price', trans('room::labels.backend.room.table.agent_sell_price'), ['class' => 'col-lg-2 control-label']) }}

                                            <div class="col-lg-10">
                                                {{ Form::text('agent_sell_price', null, ['class' => 'form-control', 'placeholder' => trans('room::labels.backend.room.table.agent_sell_price')]) }}
                                            </div><!--col-lg-10-->
                                        </div><!--form control-->
                                    </div> <!-- tab-pane -->

                                    <div class="tab-pane {{ ($tab=='amenities')?'active':'' }}" id="amenities">
                                        <div class="col-md-offset-1">
                                            <div class="form-group">         
                                                @foreach($amenities as $amenity)
                                                    <div class="col-lg-3">                                                 
                                                        <input type="checkbox"  value="{{ $amenity->id }}" id="{{$amenity->name}}" name="amenity_id[]" @if(old('amenity_id'))@if(in_array($amenity->id,old('amenity_id'))) checked @endif @endif>
                                                        <label for="{{$amenity->name}}" class="control-label">{{ $amenity->name }}</label>
                                                    </div>                        
                                                @endforeach
                                            </div>
                                        </div>

                                    </div> <!-- tab-pane -->
                                </div><!-- tab-content -->
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-6 -->
            </div><!-- /.box-body -->
        </div><!--box-->
        
       <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.room.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->
                {{ Form::close() }} 

    
@stop

@section('after-scripts')
<script src="/js/backend/plugin/bootstrap-summernote/summernote.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){
            $('.select2').select2({ 
              placeholder:"Please Select"
            });

            $('.nav-tabs li a').click(function(){
                $('input[name=tab]').val($(this).attr('href').replace('#',''));
                $('.tab_label').empty();
                $('.tab_label').append(ucFirst($('input[name=tab]').val()));
            });
            

            function ucFirst(string) {
                return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();
            }
            
            $('.editor').summernote({
                height: 300
            });
        });
    </script>
@stop