@extends('admin.admin_master')

@section('admin')

   

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card-header">All Slider</div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Slider Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->descripton }}</td>
                                    <td><img src="{{ URL::to('public/storage/'.$brand->brand_image) }}" style="height: 40px; width: 70px;" alt=""></td>

                                    <td>
                                        <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('slider/delete/'.$slider->id)  }}" class="btn btn-danger" >Trash</a>
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


@endsection