<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title>ZX News</title>

		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="scripts/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script>
		<style>
		.glyphicon {
			margin-right: 4px !important; /*override*/
		}
		.pagination .glyphicon {
			margin-right: 0px !important; /*override*/
		}
		.pagination a {
			color: #555;
		}
		.panel ul {
			padding: 0px;
			margin: 0px;
			list-style: none;
		}
		.news-item {
			padding: 4px 4px;
			margin: 0px;
			border-bottom: 1px dotted #555;
		}
		</style>
		<script type="text/javascript">
		$(function () {
			$(".demo").bootstrapNews({
				newsPerPage: 4,
				navigation: true,
				autoplay: true,
				direction:'up', // up or down
				animationSpeed: 'normal',
				newsTickerInterval: 4000, //4 secs
				pauseOnHover: true,
				onStop: null,
				onPause: null,
				onReset: null,
				onPrev: null,
				onNext: null,
				onToDo: null
			});
		});
		</script>
	</head>
	<body>	
		<div class="panel panel-default">
			<div class="panel-heading"> <span class="glyphicon glyphicon-list-alt"></span><b>News</b></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">
						<ul class="demo">

							<li class="news-item">
								<table cellpadding="4">
									<tr>
										<td><img src="images/1.png" width="60" class="img-circle" /></td>
										<td> News 1<a href="#">Read more...</a></td>
									</tr>
								</table>
							</li>

							<li class="news-item">
								<table cellpadding="4">
									<tr>
										<td><img src="images/2.png" width="60" class="img-circle" /></td>
										<td> News 2<a href="#">Read more...</a></td>
									</tr>
								</table>
							</li>

							<li class="news-item">
								<table cellpadding="4">
									<tr>
										<td><img src="images/3.png" width="60" class="img-circle" /></td>
										<td> News 3<a href="#">Read more...</a></td>
									</tr>
								</table>
							</li>		
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-footer"> </div>
		</div>
  
	</body>
</html>