@extends('layouts.app')
@section('content')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Change Password</h2>
        </div>
    </div>
</section>
<section class="dashboard">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{ Form::open(['url' => route('user.saveChangePassword'), 'files' => true, 'role'=>'form', 'method' => 'post']) }}
                @if(session('success'))
                <div class="alert alert-success fade in">
                    <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
                    <strong>{{ __('Success!') }}</strong> {{session('success')}}
                </div>
                @endif

                {{ Form::open(['url' => route('user.saveChangePassword'), 'class' => 'form-horizontal clearfix']) }}

                <div class="row form-group">
                    <label class="control-label">
                        {{ __('Old Password') }}<span class="required">*</span>
                    </label>
                    {{ Form::password('old_password', ['class'=>'form-control', 'placeholder'=> __('Old Password'), 'maxlength' => 20]) }}
                </div>

                <div class="row form-group">
                    <label class="control-label">
                        {{ __('New Password') }}<span class="required">*</span>
                    </label>
                    {{ Form::password('new_password',['class'=>'form-control', 'placeholder'=> __('New Password'), 'maxlenght' => 20 ]) }}
                </div>

                <div class="row form-group">
                    <label class="control-label">{{ __('Confirm Password') }}<span class="required">*</span></label>
                    {{ Form::password('confirm_password',['class'=>'form-control', 'placeholder'=> __('Confirm Password'), 'maxlength' => 20]) }}
                </div>

                <div class="form-group">
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</section>
@endsection
