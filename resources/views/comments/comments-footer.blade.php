<div class="box">
  <div class="box-header with-border">
    <div class="user-block">
      <span class="box-title">Comentarios</span>
      <span class="description">Última actualización hoy 7:30 PM</span>
    </div>
    <!-- /.box-tools -->
  </div>
    <!-- /.box-footer -->
    <div class="box-footer" style="">
      <form action="#" method="post">
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Press enter to post comment">
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat">Go!</button>
          </span>
        </div>
        </div>
      </form>
      <div class="box-footer box-comments" style="">
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="{{ Gravatar::get($user->email) }}" alt="User Image">
    
          <div class="comment-text">
                <span class="username">
                  Maria Gonzales
                  <span class="text-muted pull-right">8:03 PM Today</span>
                </span><!-- /.username -->
            It is a long established fact that a reader will be distracted
            by the readable content of a page when looking at its layout.
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="{{ Gravatar::get($user->email) }}" alt="User Image">
    
          <div class="comment-text">
                <span class="username">
                  Nora Havisham
                  <span class="text-muted pull-right">8:03 PM Today</span>
                </span><!-- /.username -->
            The point of using Lorem Ipsum is that it has a more-or-less
            normal distribution of letters, as opposed to using
            'Content here, content here', making it look like readable English.
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
      </div>
    </div>
    <!-- /.box-footer -->
</div>