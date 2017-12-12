@extends("dash")

@section("pagetitle", " Mail Box")

@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/parsley.css">
  <link rel="stylesheet" type="text/css"  href="/css/select2.css">
@endsection

@section("content")

      <div class="row">
        <div class="col-md-3">
          <a href="{{ route('newsletter.index')}}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
          <br>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox<span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="#"><i class="fa fa-star-o"></i> Important</a></li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <form name="sentMessage" id="contactForm" action="{{route('newsletter.store')}}" method="post" enctype="multipart/form-data">

              <input type="hidden" name="_token" value="{{csrf_token()}}">
              {{method_field("POST")}}

              <div class="box-body">

                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Subject</label>
                          <input type="text" class="form-control" placeholder="subject :" id="subject" name="subject" required data-validation-required-message="Please write a short subject." value="{{old('subject')}}">
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>

                  <div class="row control-group">
                      <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Body</label>
                          <textarea rows="7" class="form-control" placeholder="Body" id="body" name="body" data-validation-required-message="Please write the body.">{{old('body')}}</textarea>
                          <p class="help-block text-danger"></p>
                      </div>
                  </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
              </div>
            </form>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  
@endsection
@section('scripts')
  <script type="text/javascript" src="/js/parsley.min.js"></script>
  <script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>

  <script type="text/javascript">
    $(".select2").select2();
  </script>

  <script type="text/javascript">
  tinymce.init({
    selector: 'textarea#body',
    theme: 'modern',
    menubar: false,
    plugins: [
      'advlist autolink autoresize lists link image charmap print preview hr anchor pagebreak',
      'wordcount fullscreen fullpage',
      'save table contextmenu directionality',
      'emoticons template paste textcolor textpattern imagetools toc help'
    ],
    toolbar1: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'fullpage print preview | forecolor backcolor emoticons | help',
    templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
    ]
 });
  </script>

@endsection 