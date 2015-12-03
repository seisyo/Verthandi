@extends('component.layout', ['title' => 'SITCON 2016'])

{{-- Custom css section --}}
@section('custom_css')
    @parent
    <link rel="stylesheet" href="{{url('assets/css/bootstrap-datepicker3.css')}}">
    <link href="{{url('assets/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
@endsection

{{-- Custom js section --}}
@section('custom_js')
    @parent
    <script src="{{url('assets/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('assets/js/plugins/footable/footable.all.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(".footable").footable();
        });
    </script>
@endsection

{{-- Sidebar default/event --}}
@section('sidebar')
    @include('component.navbar.event')
@endsection

{{-- Breadcrumb section --}}
@section('breadcrumb')
<h2>
    SITCON 2016
</h2>
<li>
    <a href="{{url('/')}}">首頁</a>
</li>
<li>
    <a>活動帳簿管理</a>
</li>
<li>
    <a>SITCON 2016</a>
</li>
<li>
    <a>日記簿</a>
</li>
@endsection

{{-- Content section --}}
@section('content')

<div class="row">
    <div class="col-md-12">
        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
            <thead>
                <tr>

                    <th data-toggle="true">Project</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th data-hide="all">Company</th>
                    <th data-hide="all">Completed</th>
                    <th data-hide="all">Task</th>
                    <th data-hide="all">Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Project - This is example of project</td>
                    <td>Patrick Smith</td>
                    <td>0800 051213</td>
                    <td>Inceptos Hymenaeos Ltd</td>
                    <td><span class="pie">0.52/1.561</span></td>
                    <td>20%</td>
                    <td>Jul 14, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Alpha project</td>
                    <td>Alice Jackson</td>
                    <td>0500 780909</td>
                    <td>Nec Euismod In Company</td>
                    <td><span class="pie">6,9</span></td>
                    <td>40%</td>
                    <td>Jul 16, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Betha project</td>
                    <td>John Smith</td>
                    <td>0800 1111</td>
                    <td>Erat Volutpat</td>
                    <td><span class="pie">3,1</span></td>
                    <td>75%</td>
                    <td>Jul 18, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Gamma project</td>
                    <td>Anna Jordan</td>
                    <td>(016977) 0648</td>
                    <td>Tellus Ltd</td>
                    <td><span class="pie">4,9</span></td>
                    <td>18%</td>
                    <td>Jul 22, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Alpha project</td>
                    <td>Alice Jackson</td>
                    <td>0500 780909</td>
                    <td>Nec Euismod In Company</td>
                    <td><span class="pie">6,9</span></td>
                    <td>40%</td>
                    <td>Jul 16, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Project
                        <small>This is example of project</small>
                    </td>
                    <td>Patrick Smith</td>
                    <td>0800 051213</td>
                    <td>Inceptos Hymenaeos Ltd</td>
                    <td><span class="pie">0.52/1.561</span></td>
                    <td>20%</td>
                    <td>Jul 14, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Gamma project</td>
                    <td>Anna Jordan</td>
                    <td>(016977) 0648</td>
                    <td>Tellus Ltd</td>
                    <td><span class="pie">4,9</span></td>
                    <td>18%</td>
                    <td>Jul 22, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Project
                        <small>This is example of project</small>
                    </td>
                    <td>Patrick Smith</td>
                    <td>0800 051213</td>
                    <td>Inceptos Hymenaeos Ltd</td>
                    <td><span class="pie">0.52/1.561</span></td>
                    <td>20%</td>
                    <td>Jul 14, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Alpha project</td>
                    <td>Alice Jackson</td>
                    <td>0500 780909</td>
                    <td>Nec Euismod In Company</td>
                    <td><span class="pie">6,9</span></td>
                    <td>40%</td>
                    <td>Jul 16, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Betha project</td>
                    <td>John Smith</td>
                    <td>0800 1111</td>
                    <td>Erat Volutpat</td>
                    <td><span class="pie">3,1</span></td>
                    <td>75%</td>
                    <td>Jul 18, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Gamma project</td>
                    <td>Anna Jordan</td>
                    <td>(016977) 0648</td>
                    <td>Tellus Ltd</td>
                    <td><span class="pie">4,9</span></td>
                    <td>18%</td>
                    <td>Jul 22, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Alpha project</td>
                    <td>Alice Jackson</td>
                    <td>0500 780909</td>
                    <td>Nec Euismod In Company</td>
                    <td><span class="pie">6,9</span></td>
                    <td>40%</td>
                    <td>Jul 16, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Project
                        <small>This is example of project</small>
                    </td>
                    <td>Patrick Smith</td>
                    <td>0800 051213</td>
                    <td>Inceptos Hymenaeos Ltd</td>
                    <td><span class="pie">0.52/1.561</span></td>
                    <td>20%</td>
                    <td>Jul 14, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
                <tr>
                    <td>Gamma project</td>
                    <td>Anna Jordan</td>
                    <td>(016977) 0648</td>
                    <td>Tellus Ltd</td>
                    <td><span class="pie">4,9</span></td>
                    <td>18%</td>
                    <td>Jul 22, 2013</td>
                    <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                </tr>
            </tbody>    
            <tfoot>
                <tr>
                    <td colspan="5">
                        <ul class="pagination pull-right"></ul>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection
