@include('admin.assets.navbar')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">


    <div class="container">


        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        @if (Session::has('done'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ Session::get('done') }}
                            </div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        
                        @elseif ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Add Admins</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <div class="row">
                            <div class="col-lg-6 col-12 mx-auto">
                                <form method="post" action="{{ route('owner.admins.add') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label style="direction:ltr"  for="fullName">Full Name :</label>
                                        <input type="text" name="name" class="form-control" id="fullName" placeholder="Ex: Alan Green">
                                    </div>
                                    <div class="form-group">
                                        <label style="direction:ltr"  for="email">email :</label>
                                        <input type="email" name="email" class="form-control" id="Email" placeholder="Ex: Alan@gmail.com">
                                    </div> 
                                    <div class="form-group">
                                        <label style="direction:ltr"  for="password">Password :</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Ex: password">
                                    </div> 
                                    <div class="form-group">
                                        <label style="direction:ltr"  for="t-text">Role :</label>
                                        <select data-live-search="true" class="selectpicker form-control"
                                            name="role_id" id="t-text">

                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-primary mt-3" type="submit">Add</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="tableProgress" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Admins Table</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            @if (count($admins) != 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Created</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td class="text-center">{{ $admin->id }}</td>
                                                <td class="text-center">{{ $admin->name }}</td>
                                                <td class="text-center">{{ $admin->email }}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        @foreach($admin->roles as $role)
                                                        <li>
                                                    {{ $role->roleData->name }}
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    @if($admin->status)
                                                    <span class="text-success">Activated</span>
                                                    @else
                                                    <span class="text-danger">Not Activated</span>
                                                    @endif
                                                </td>
                                                <td style="direction:ltr" class="text-center">{{ $admin->created_at->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('owner.admins.editStatus', $admin->id) }}">
                                                                @csrf
                                                                @if($admin->status)
                                                                <button class="btn btn-danger" type="submit">Ban</button>
                                                                @else
                                                                <button class="btn btn-success" type="submit">Activate</button>
                                                                @endif
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('owner.admins.delete', $admin->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-dark" type="submit"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash-2">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg></button>
                                                            </form>
                                                        </li>

                                                    </ul>


                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <h2>There is no Admins Yet !</h2>
                            @endif
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!--  END CONTENT AREA  -->
@include('admin.assets.footer')
