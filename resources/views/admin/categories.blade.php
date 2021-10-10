@include('admin.assets.navbar')


<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="container">

        <div class="container">


            <div class="row layout-top-spacing">

                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add Category</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
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
                                <div class="col-lg-6 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.category.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="t-text">Category Name :</label>
                                            <input id="t-text" type="text" name="name" placeholder="Enter category name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="t-text">Category Icon :</label>
                                            <input id="t-text" type="text" name="icon" placeholder="Enter category icon" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Category Image : <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="image" accept="image/*">
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-3 mb-2" type="submit">Add</button>
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
                                    <h4>Categpries Table</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Products Count</th>
                                            <th class="text-center">Related Product Colors</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="text-center">{{ $category->id }}</td>
                                                <td class="text-center">{{ $category->name }}</td>
                                                <td class="text-center">{{ $category->icon }}</td>
                                                <td class="text-center"><img
                                                        src="{{ asset('images/CategoriesImages/' . $category->image) }}"
                                                        style="max-height:50px" alt=""></td>
                                                <td class="text-center">{{ $category->countOfProducts }}</td>
                                                <td class="text-center">{{ $category->countOfAllProductColors }}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls">
                                                        <li>
                                                            <form method="get"
                                                                action="{{ route('admin.category.edit', $category->id) }}">
                                                                <button class="btn btn-dark" type="submit"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-edit-2">
                                                                        <path
                                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                        </path>
                                                                    </svg></button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form method="post"
                                                                action="{{ route('admin.category.delete', $category->id) }}">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
@include('admin.assets.footer')
