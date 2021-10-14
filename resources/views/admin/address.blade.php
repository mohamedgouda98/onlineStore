@push('styles')
    <link rel="stylesheet" href="{{asset('adminAssets/plugins/animate/animate.css')}}">
    <link rel="stylesheet" href="{{asset('adminAssets/assets/css/scrollspyNav.css')}}">
    <link rel="stylesheet" href="{{asset('adminAssets/assets/css/components/custom-modal.css')}}">
    <link rel="stylesheet" href="{{asset('adminAssets/assets/css/tables/table-basic.css')}}">
    <link rel="stylesheet" href="{{asset('adminAssets/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('adminAssets/plugins/table/datatable/dt-global_style.css')}}">
@endpush
@include('admin.assets.navbar')
 <!--  BEGIN CONTENT AREA  -->
 <div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h2>Address detail</h2>
                    <a type="button" class="btn btn-secondary mb-2 mr-2" data-toggle="modal" data-target="#addAddress">
                        Add Address
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endforeach
                @endif
            </div>
            <div class="done">
                @if (Session::has('done'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{Session::get('done')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
            </div>
        </div>
        <div class="container">

            <!-- Modal Add Address -->
            <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="addAddressLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAddressLabel">Add detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('admin.address.add')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="user">User Name</label>
                                            <select class="custom-select" name="user_id" id="user">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input id="phone" type="number" name="phone" class="form-control" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="city" placeholder="city" id="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="detail" placeholder="detail" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>City</th>
                                    <th>Address detail</th>
                                    <th class="no-content">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addressTable as $address)


                                <tr>
                                    <td>{{$address->usersAddresses->name}}</td>
                                    <td>{{$address->phone}}</td>
                                    <td>{{$address->city}}</td>
                                    <td>{{$address->detail}}</td>

                                    <td class="">
                                        <ul class="table-controls">
                                            <li><a type="button"  class="bs-tooltip" data-placement="top" title="" data-original-title="Edit" data-toggle="modal" data-target="#editAddress"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>

                                            <li><a type="button" class="bs-tooltip" data-placement="top" title="" data-original-title="Delete" data-toggle="modal" data-target="#deleteAddress_{{$address->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                        </ul>

                                    </td>
                                                <!-- delete -->
                                            <div class="modal fade " id="deleteAddress_{{$address->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteAddressLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAddressLabel">Delete Address</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" 		height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-		width="2" stroke-linecap="round" stroke-linejoin="round" class="feather 		feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" 		x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="modal-text">Are You Sure? </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{route('admin.address.delete',[$address->id])}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                <button type="submit" class="btn btn-primary">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- edit -->
                                            <div class="modal fade " id="editAddress" tabindex="-1" role="dialog" aria-labelledby="editAddressLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editAddressLabel">Update Address</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" 		height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-		width="2" stroke-linecap="round" stroke-linejoin="round" class="feather 		feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" 		x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{route('admin.address.update',[$address->id])}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="user">User Name</label>
                                                                            <select class="custom-select" name="user_id" id="user" {{$address->user_id}}>
                                                                                @foreach($users as $user)
                                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="phone">Phone Number</label>
                                                                            <input id="phone" type="number" name="phone" value="{{$address->phone}}" class="form-control" placeholder="Phone Number">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" value="{{$address->city}}" name="city" placeholder="city" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea name="detail" placeholder="detail" class="form-control" rows="3">{{$address->detail}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@push('scriptsBottom')
    <script src="{{asset('adminAssets/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
    <script src="{{asset('adminAssets/assets/js/scrollspyNav.js')}}"></script>
@endpush
<!-- END PAGE LEVEL SCRIPTS -->
@include('admin.assets.footer')
