@extends('layouts.app')

@section('page_javascript')
    <script src="/js/test-app.js"></script>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="/">Home</a>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Test Application
                </div>

                <div class="panel-body">
                    <!-- check auth -->
                    <div id="form-email" class="form-group">
                        <label for="email" class="col-md-3 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email">
                        </div>
                        <button class="btn btn-primary" id="btn-check-email">
                            Check Email
                        </button>
                    </div>
                    <table id="table-auth" class="hidden">
                        <tbody>
                            @for($row = 0; $row < 6; $row++)
                            <tr>
                                @for($column = 0; $column < 10; $column++)
                                    <td row={{$row}} column={{$column}}>
                                        <div>
                                            <div></div>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                            @endfor 
                        </tbody>
                    </table>

                    <!-- profile -->
                    <div id="user-profile" class="user-profile row hidden">
                        <div class="col-xs-12 col-sm-3 center">
                            <div class="profile-picture">
                                <div class="file-preview" style="background-image: url(/assets/images/avatars/user.png); cursor: auto;">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9 form-group">
                            <div class="profile-user-info profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Full Name </div>

                                    <div class="profile-info-value">
                                    <label id="full-name"></label>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Phone Number </div>

                                    <div class="profile-info-value">
                                    <label id="phone-number"></label>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Gender </div>

                                    <div class="profile-info-value">
                                        <label id="gender"></label>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Birthday </div>

                                    <div class="profile-info-value">
                                        <label id="birthday"></label>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> About Me </div>

                                    <div class="profile-info-value">
                                        <textarea id="about" class="form-control" cols="5" rows="4" Disabled></textarea>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Hashes </div>

                                    <div class="profile-info-value">
                                    <label id="auth"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var path_avatar = {{\Config::get('app.avatar')}};
</script>
@endsection
