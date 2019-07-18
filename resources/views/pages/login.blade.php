@extends('layouts.login')

@section('content')
    <!-- BEGIN LOGIN FORM -->
    <form form-action="login" v-on:submit.prevent="handleLogin()">
        <h3 class="form-title font-green">Sign In</h3>
        @include('includes.alert')
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">CoCd</label>
            <select name="cocd" class="form-control">
                <option value="" selected hidden disabled>Cocd</option>
                <option v-for="comp in company" :value="comp.CoCd">@{{comp.CoCd}}</option>
            </select>
            <div class="help-block text-danger display-hide" help-name="cocd"></div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">User Code</label>
            <input class="form-control" type="text" autocomplete="off" placeholder="User Code" name="usercd" />
            <div class="display-hide help-block text-danger" help-name="usercd"></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control" type="password" autocomplete="off" placeholder="Password" name="password" />
            <div class="help-block text-danger display-hide" help-name="password"></div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn green uppercase">Login</button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
@endsection