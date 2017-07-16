@extends('layouts.master')

@section('title','套版-後台管理系統')

@section('content')
        <div class="content" id="panel-list">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Member Table</h4>
                                <p class="category">Here is a subtitle for this table</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <div class="content">
                                    <button type="button" class="btn btn-wd btn-info" id="btn-create">
                                        <span class="btn-label">
                                            <i class="fa fa-user-plus"></i>
                                        </span>
                                        新增會員
                                    </button>
                                </div>
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if( count($members)==0 )
                                            <tr colspan="3"><td>目前尚無資料</td></tr>
                                        @else
                                            @foreach( $members as $index => $member)
                                            <tr>
                                                <td class="text-center">{{ $index+1 }}</td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td class="td-actions text-right">

                                                    <a href="ShowMember?id={{ $member->id }}" rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                    <a href="UpdateMember?id={{ $member->id }}" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>      
                                                    <a class="btn btn-danger btn-simple btn-xs" onclick="del({{$member->id}})">
                                                        <i class="fa fa-times"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        
                                    </tbody>
                                </table>

                                <div class="fixed-table-pagination">
                                    <div style="margin: 0px 20px;">
                                        {{ $members->render() }}
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="content" id="panel-form" style="display:none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Insert Profile</h4>
                            </div>
                            <div class="content">
                                
                                <form method="POST" name="user_form">
                                    {{ csrf_field() }}
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" placeholder="Name" v-model="row.name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Email" v-model="row.email">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    <button type="button" class="btn btn-wd btn-default" v-on:click="cancel">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>
                                        Back
                                    </button>
                                    <button type="submit" class="btn btn-info btn-fill pull-right" v-on:click="createUser">Insert Profile</button>
                                    <div class="clearfix"></div>
                                
                            </div>
                        </div>
                    </div>
                

                </div>
            </div>
        </div>


@stop

@section('script')

<script type="text/javascript">
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var panvelForm = new Vue({
        el: '#panel-form',
        data: {
            type: 'create',
            row: {
                _token: csrf_token,
            }
        },
        methods: {
            close: function(e) {
                $('#panel-form').hide();
                $('#panel-list').show();
            },
            cancel: function(e) {
                if (e) e.preventDefault();
                this.close();
            },
            createUser: function createUser() {
                var _this = this;
                $.ajax({
                    type: 'POST',
                    url: "postInsertMember",
                    data: this._data.row,
                    dataType: "json",
                    success: function(data) {
                        if(data.result){
                            swal({
                                title: "created",
                                text: data.message,
                                type: "success"
                            }, function () {
                                window.location.href = '/member';
                            });
                        }
                        else{
                            swal({
                                title: "failed",
                                text: data.message,
                                type: "info"
                            });
                        }
                    }
                });
            }
        }
    });

    $('#btn-create').click(function(e) {
        $('#panel-list').hide();
        $('#panel-form').show();
        document.user_form.reset();
    });
</script>
@stop



