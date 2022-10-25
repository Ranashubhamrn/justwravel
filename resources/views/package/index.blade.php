@extends('layouts.app')
@section('content')
    <section id="basic-datatable" class="filter-section">
        <section class="tooltip-validations" id="tooltip-validation">
            <div class="row">
                <div class="col-12">
                    <div class="card">





                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Packages </h4>

                        <a class="btn btn-primary text-white mb-2 float-right" href="{{ route('package-create') }}">Add
                            Package</a>

                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration no-wrap" id="justwravelDatatable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th class="no-sort">Title</th>
                                            <th class="no-sort">Slug</th>
                                            <th class="no-sort">Occupancy</th>
                                            <th>Price</th>
                                            <th>Discounted Price</th>
                                            <th>Duration</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        var table = "";
        $(document).ready(function() {
            table = $('#justwravelDatatable').DataTable({
                dom: 'lBfrtip',
                buttons: [

                ],

                "lengthMenu": [10, 100, 500, 1000, 2000, 5000, 10000],
                serverSide: true,
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }],
                "order": [
                    [0, "desc"]
                ],
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Content-type": "application/json"
                    },
                    url: '/',
                    type: 'GET',
                    data: function(d) {
                        return $.extend({}, d, {

                        });
                    },
                    dataFilter: function(data) {
                        var newData = jQuery.parseJSON(data);
                        var json = {
                            recordsTotal: newData.total,
                            recordsFiltered: newData.total,
                            draw: newData.draw,
                            data: newData.data
                        };
                        return JSON.stringify(json); // return JSON string
                    }
                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: "title"
                    },
                    {
                        data: "slug"
                    },
                    {
                        data: "occupancy"
                    },
                    {
                        data: "price"
                    },
                    {
                        data: "disc_price"
                    },

                    {
                        data: "duration"
                    },


                ],
            });

        });
    </script>
@endsection
