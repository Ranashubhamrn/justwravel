@extends('layouts.app')
@section('content')
    <div class="card m-4">
        <div class="card-header">

            <h2 class="content-header-title mb-2">Add Package</h2>
            <a class="btn btn-primary text-white mb-2 float-right" href="{{ route('get-package') }}">Back
            </a>
        </div>
        <div class="card-body">
            <form method='post' action='{{ route('package-store') }}' class="col-sm-6">
                @csrf
                @method('POST')
                <div class="form-group ">
                    <label for="title">Title:</label>
                    <input type="text" value="{{ old('title') }}" class="form-control" id="title" name="title"
                        required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="name">Duration Days:</label>
                    <input type="number" value="{{ old('duration') }}" class="form-control" id="duration" name="duration"
                        required>
                    @error('duration')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Select Occupancy</label>
                    <select class="select2
                    form-control" name="occupancy_id" required>
                        <option value="">--Select--</option>
                        @forelse ($occupancies as $key => $occupancy)
                            <option value="{{ $occupancy->id }}">{{ $occupancy->occupancy }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
