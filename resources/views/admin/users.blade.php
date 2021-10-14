@include('admin.assets.navbar')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">


    <div class="container">


        <div class="row layout-top-spacing">

            <div id="tableProgress" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Users Table</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
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
                            @if (count($users) != 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Address</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Created</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $user->id }}</td>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->addresses[0]->city }} , {{ $user->addresses[0]->detail }} , {{ $user->addresses[0]->phone }}</td>
                                                
                                                <td class="text-center">
                                                    @if($user->status)
                                                    <span class="text-success">Activated</span>
                                                    @else
                                                    <span class="text-danger">Not Activated</span>
                                                    @endif
                                                </td>
                                                <td style="direction:ltr" class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('admin.users.editStatus', $user->id) }}">
                                                                @csrf
                                                                @if($user->status)
                                                                <button class="btn btn-danger" type="submit">Ban</button>
                                                                @else
                                                                <button class="btn btn-success" type="submit">Activate</button>
                                                                @endif
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('admin.users.delete', $user->id) }}">
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
                                <h2>There is no Users Yet !</h2>
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
