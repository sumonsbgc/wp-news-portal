<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>Bagla Converter  || <?php echo esc_html(get_bloginfo( 'name' )); ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('/css/converter.css',__DIR__  ) ?>">


	<script src="https://news.test/wp-includes/js/jquery/jquery.min.js?ver=3.6.0"></script>



</head>
<body class="bg-light">
<?php 
$bangla_converter_options = get_option( 'bangla_converter_option_name' );
$logo = $bangla_converter_options['logo_url_0'];
$copyright =  $bangla_converter_options['copyright_text_1']?>

<div class="container">
	<div class="row"> 
		<div class="logo-top text-center">
			<?php if ($logo ) {
				?>
				<img class="img-fluid" style="max-width: 50%;height: auto;" src="<?php echo $logo ?>">
			<?php }else{
				echo '<h2>বাংলা কনভার্টার</h2>';
			} ?>
			
			<p>সহজেই কনভার্ট করুন বাংলা ফন্ট</p>
		</div>

	</div>

	<div class="row">
		<div class="converter-form">
			<div class="bijoy-area pt-2">
				<textarea class="form-control input-bijoy" placeholder="বিজয় কি-বোর্ডের লেখা এখানে পেস্ট করুন"></textarea>
			</div>
			
			<div class="convert-button-area text-center pt-4">
				<button class="btn btn-success" id="b2u"><i class="fa fa-arrow-down" aria-hidden="true"></i>
 বিজয় থেকে ইউনিকোড</button>
				<button class="btn btn-success" id="u2b"><i class="fa fa-arrow-up" aria-hidden="true"></i>
 ইউনিকোড থেকে বিজয়</button>
				<button class="btn btn-danger" id="clear-both"><i class="fa fa-trash" aria-hidden="true"></i>
 মুছে ফেলুন</button>
				
			</div>
			

			<div class="unicode-area pb-2">
				<textarea class="form-control input-unicode" placeholder="ইউনিকোড কি-বোর্ডের লেখা এখানে পেস্ট করুন"></textarea>
			</div>

		</div>
	</div>
  
</div>
<hr>
<footer>
	<div class="container">
		<div class="row">

			<p class="text-center copyright-c">
				<?php if ($copyright) {
					echo $copyright;
				} else{ echo esc_html(get_bloginfo( 'name' )); ?> © <?php echo esc_html(date('Y'));} ?>
					
				</p>
		</div>
	</div>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script type="text/javascript" >
    jQuery(document).ready(function($) {

        function convertBangla(convert,text,result) {
        	var data = {
            'action': 'bnconverter_action',
            'convert': convert,
            'text' : text
        };

        jQuery.post('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', data, function(response) {
            $(result ).val(response);
        });
        }

        // Convert Unicode to bijoy
        $( "#u2b" ).click(function() {
        	var convert = 'u2b';
        	var text = $( ".input-unicode" ).val();
        	var result = '.input-bijoy';
         convertBangla(convert,text,result);
          

         });

        $( "#b2u" ).click(function() {
        	var convert = 'b2u';
        	var text = $( ".input-bijoy" ).val();
        	var result = '.input-unicode';
         convertBangla(convert,text,result);
          

         });




        $( "#clear-both" ).click(function() {
          $( ".input-bijoy" ).val('');
          $( ".input-unicode" ).val('');
          

         });


    });
    </script>
</html>