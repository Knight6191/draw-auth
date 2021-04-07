@extends('layouts.app')

@section('page_javascript')
    <script src="/js/auth.js"></script>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href='/main'>Main Application</a> <i class="ace-icon fa fa-angle-double-right"></i> Auth</div>

                <div class="panel-body">
                    <table id="table-auth">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
