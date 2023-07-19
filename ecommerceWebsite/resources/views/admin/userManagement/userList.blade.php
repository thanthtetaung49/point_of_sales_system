@extends('layouts.main')

@section('dataSection')
    <div class="col-12">
        <div class="col-12 mt-3">
            @if (count($userData) > 0)
                <table id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Profile Photo</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td class="col-2 text-center">{{ $item->name }}
                                    <input id="userId" type="hidden" value="{{ $item->id }}">
                                </td>
                                <td class="col-2 text-center">
                                    @if ($item->image_name == null)
                                        <img class="w-50" src="{{ asset('defaultImage/defaultMale.jfif') }}"
                                             alt="product_default">
                                    @else
                                        <img class="w-50" src="{{ asset('storage/profileImage/' . $item->image_name) }}"
                                             alt="{{ $item->image_name }}">
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">
                                    <div class="form-group">
                                        <select class="form-select userRole" name="userRole">
                                            @if ($item->role == 'user')
                                                <option value="user" selected>User</option>
                                                <option value="admin">Admin</option>
                                            @else
                                                <option value="user">User</option>
                                                <option value="admin" selected>Admin</option>
                                            @endif
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h1 class="text-center mt-5">There is no data.</h1>
            @endif

            <div class="mt-3">
                {{ $userData->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#table").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            $("#table_paginate").hide();
            $("#table_info").hide();
            $("#table_filter").hide();

            $(".userRole").change(function(e) {
                e.preventDefault();
                let userId = $(this).parents('tr').find('#userId').val();
                let userRole = $(this).val();

                $.ajax({
                    type: "post",
                    url: "http://localhost:8000/api/userRoleChange",
                    data: {
                        userId: userId,
                        userRole: userRole
                    },
                    dataType: "json",
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
