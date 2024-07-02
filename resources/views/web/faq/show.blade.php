<x-website-layout>
    @include('web.faq.css')
    @push('styles')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @endpush
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="portlet-body">
                <div id="ajaxCrudDatatable">
                    <div id="crud-datatable" class="grid-view" data-krajee-grid="kvGridInit_0b96d585">
                        <div class="panel panel-primary">
                            <div class="panel-heading bg-blue-skhcn no-border no-border-radius">

                                <h3 class="panel-title">
                                    <i class="glyphicon glyphicon-list"></i> <b style="font-size: 14px;">Chi tiết hỏi -
                                        đáp</b>
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div id="crud-datatable-container" class="table-responsive kv-grid-container">
                                <div style="border: 1px solid d6d6d6; border-radius: 6px;">
                                    <div>
                                        <span style="margin-left: 10px;"><b>{{ $faq->title }}</b> (Số lượt xem:
                                            245)</span>
                                        <hr
                                            style="border-top: 1px solid #d6d6d6; margin-top: 0px; margin-left: 10px; width: 98%; text-align: center;">
                                    </div>
                                    <div>
                                        <span style="margin-left: 10px;"><b>Hỏi : </b>(<b
                                                style="color: #000eaf;">{{ $faq->name }}</b> -
                                            {{ $faq->email }})</span>
                                        <div
                                            style="margin:20px auto; border: 1px solid #d6d6d6; border-radius: 6px; height: auto; width: 95%; font-size: 14px; padding: 5px">
                                            <p
                                                style="margin-top: 5px;margin-left: 10px;margin-right: 1px; font-size: 13px;">
                                                {!! $faq->question !!}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <span style="margin-left: 10px;"><b>Trả lời : </b></span>
                                        <div
                                            style="margin: 20px auto ; border: 1px solid #d6d6d6; border-radius: 6px; height: auto; width: 95%; font-size: 14px;">
                                            @if ($faq->answer)
                                                <p
                                                    style="margin-top: 5px;margin-left: 10px;margin-right: 1px; font-size: 13px;">
                                                    {!! $faq->answer !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website-layout>
