<div id="content" class="main-content">
    <div class="container">

        <div class="container">


            <div class="row layout-top-spacing">

                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add ads</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                        @if (Session::has('done'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ Session::get('done') }}
                    </div>
                    @endif
                            <div class="row">
                                <div class="col-lg-6 col-12 mx-auto">
                                    <form method="POST" action="{{Route('admin.ads.update',[$ad->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>url</label>
                                            <input type="text" name="url" class="form-control" placeholder="Enter ..." value="{{$ad->$url}}">
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="imgUpdate">Img</label>
                                        <input type="file" name="image" class="form-control-file" id="imgUpdate"value="{{$ad->$image}}>
                                        </div>
                                        </div>
                                        <div class="col-12">
                                        <div class="form-group">
                                            <label>slug</label>
                                            <textarea name="slug" class="form-control" rows="3" placeholder="Enter ..."value="{{$ad->$slug}}></textarea>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>