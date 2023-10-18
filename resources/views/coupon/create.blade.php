<form method="post" action="{{ route('coupons.store') }}">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                {{Form::label('name',__('Name'),array('class'=>'col-form-label'))}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
            </div>

            <div class="form-group col-md-6">
                {{Form::label('discount',__('Discount') ,array('class'=>'col-form-label')) }}
                {{Form::number('discount',null,array('class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Discount'),'required'=>'required'))}}
                <span class="small">{{__('Note: Discount in Percentage')}}</span>
            </div>
            <div class="form-group col-md-6">
                {{Form::label('limit',__('Limit') ,array('class'=>'col-form-label'))}}
                {{Form::number('limit',null,array('class'=>'form-control','placeholder'=>__('Enter Limit'),'required'=>'required'))}}
            </div>
            <div class="form-group col-md-12" id="auto">
                <div class="row">
                    <div class="col-md-10">
                        <input class="form-control" name="code" type="text" id="auto-code">
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn btn-primary btn btn-sm btn-icon-only shadow-sm" style=" border-radius: 50% !important;"
                            id="code-generate"><i class="ti ti-history"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn  btn-primary">{{__('Create')}}</button>
    </div>
</form>

