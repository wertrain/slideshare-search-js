<!DOCTYPE html>
<html lang="ja-JP">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="wertrain">

    <title>SlideShare Search</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    <!-- Custom styles for this template -->
    <link href="stylesheets/style.css" rel="stylesheet">
  </head>

  <body ng-app="App">
    <div class="container" ng-controller="MainController as main" data-ng-init="main.init()">
      <h1 class="text-center"><a href="index.html"><img src="images/slideshare_400x100.png"></img></a></h1>
    
      <div class="text-center">
        <form class="navbar-form" role="search">
          <div class="form-group">
            <input type="text" class="form-control" ng-model="main.searchKeyword" placeholder="検索ワード" required autofocus>
            <select class="form-control" ng-model="main.selectedSort" ng-options="sort as sort.label for sort in main.sortSelectMenu"></select>
          </div>
          <button ng-if="main.slideShareData !== null" type="submit" class="btn btn-default" ng-click="main.getSlideShareData()">検索</button>
          <button ng-if="main.slideShareData === null" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> 検索中...</button>
        </form>
      </div>
    
      <div class="row">
        <div ng-if="main.slideShareData !== null" class="well">
          <div class="list-group" ng-repeat="slide in main.slideShareData.Slideshow">
            <!-- 
              listURL という一時変数を用意し、リンク先としているのだけど
              ボタンが押されたときは、この一時変数をダウンロードURLに入れ替えている
              ボタンの判定と区別が面倒だったので、試したらいけたというかなり適当な方法
            -->
            <a ng-init="listURL=slide.URL" ng-href="{{ listURL }}" class="list-group-item">
              <div class="media col-md-3">
                <figure class="pull-left">
                  <img class="media-object img-rounded img-responsive" ng-src="{{ slide.ThumbnailSmallURL }}" alt="placehold.it/350x250">
                </figure>
              </div>
              <div class="col-md-6">
                <h4 class="list-group-item-heading">{{ slide.Title }}</h4>
                <p ng-if="isString(slide.Description)" class="list-group-item-text">{{ slide.Description|truncate:256 }}</p>
              </div>
              <div class="col-md-3 text-center">
                <h2><small> Format </small> {{ slide.Format }}</h2>
                <button type="button" class="btn btn-primary btn-lg btn-block" ng-click="listURL=slide.DownloadUrl">Slide Download</button>
                <p></p>
                <p>Updated: {{ slide.Created }}</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <script src="app.js"></script>
  </body>
</html>
