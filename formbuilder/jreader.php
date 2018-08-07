<?php

   $str='{"fields":[{"label":"Personal Information","field_type":"section_break","required":true,"field_options":{},"cid":"c2"},{"label":"ID Number","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c6"},{"label":"District","field_type":"dropdown","required":true,"field_options":{"options":[{"label":"Bari","checked":false},{"label":"Sanaag","checked":false},{"label":"Nugal","checked":false},{"label":"Sool","checked":false},{"label":"Benadir","checked":false},{"label":"Mudug","checked":false},{"label":"Galgaduud","checked":false},{"label":"Hiraan","checked":false}],"include_blank_option":false},"cid":"c10"},{"label":"Village/Settlement","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c14"},{"label":"Date of interview","field_type":"date","required":true,"field_options":{},"cid":"c18"},{"label":"Gender","field_type":"radio","required":true,"field_options":{"options":[{"label":"Male","checked":false},{"label":"Female","checked":false}]},"cid":"c22"},{"label":"Gender of the head of HH  ","field_type":"radio","required":true,"field_options":{"options":[{"label":"Male","checked":false},{"label":"Female","checked":false}]},"cid":"c26"},{"label":"Size of HH","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c30"},{"label":"Number of children in HH <5 years ","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c34"},{"label":"Target criteria of the beneficiaries","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2  ","checked":false},{"label":"3","checked":false},{"label":"4","checked":false},{"label":"5","checked":false},{"label":"6","checked":false}],"include_other_option":false,"description":"1 = Nutrition center   2 =Pregnant mother  / lactating mother  ,      3 = woman headed house hold   4 = IDP , 5 = Community based targeting , 6 = other "},"cid":"c42"},{"label":"Name of the enumerator","field_type":"text","required":true,"field_options":{"size":"small"},"cid":"c38"},{"label":"Which best describe your house hold status?  ","field_type":"dropdown","required":true,"field_options":{"options":[{"label":"normal resident in this area ","checked":false},{"label":"moved hear due to the drought","checked":false},{"label":"moved here due to conflict  ","checked":false},{"label":"moved here for other reasons ","checked":false}],"include_blank_option":false},"cid":"c47"},{"label":"What is your house holds normal livelihood?","field_type":"radio","required":true,"field_options":{"options":[{"label":"pastoralist ","checked":false},{"label":"agro pastoralist ","checked":false},{"label":"agriculture ","checked":false},{"label":"urban  ","checked":false},{"label":"other ","checked":false}]},"cid":"c51"},{"label":"What was your regular income before this project (Sh. So.)","field_type":"number","required":true,"field_options":{},"cid":"c56"},{"label":"What is your current income   (Sh. So.)","field_type":"number","required":true,"field_options":{},"cid":"c60"},{"label":"How much debt does your family have currently = (Sh. So )","field_type":"number","required":true,"field_options":{},"cid":"c64"},{"label":"Which of the following have you or members of your household received from NGOs or projects in the past month","field_type":"checkboxes","required":true,"field_options":{"options":[{"label":"Plumpy Nut","checked":false},{"label":"CSB oil beans","checked":false},{"label":"Rice oil beans","checked":false},{"label":"Food voucher","checked":false},{"label":"Cash or CFW","checked":false},{"label":"Medicine","checked":false},{"label":"Water or water voucher","checked":false},{"label":"NFI / other","checked":false}]},"cid":"c68"},{"label":"Collection of cash","field_type":"section_break","required":true,"field_options":{},"cid":"c73"},{"label":"How many hours  did you take to travel to the cash distribution point ","field_type":"radio","required":true,"field_options":{"options":[{"label":"<0.5 hours","checked":false},{"label":"0.5 – 1 hour","checked":false},{"label":"1-1.5 ","checked":false},{"label":"1.5- 2 hours","checked":false},{"label":"2-2.5 hours","checked":false},{"label":">2.5 hours","checked":false}]},"cid":"c77"},{"label":"How much cash did you receive?","field_type":"number","required":true,"field_options":{"description":"US"},"cid":"c81"},{"label":"Was this the amount you Expected?","field_type":"radio","required":true,"field_options":{"options":[{"label":"Yes","checked":false},{"label":"No","checked":false}]},"cid":"c85"},{"label":"How long ago did you receive your last cash transfer? ","field_type":"radio","required":true,"field_options":{"options":[{"label":"1","checked":false},{"label":"2","checked":false},{"label":"3","checked":false},{"label":"4","checked":false},{"label":"5","checked":false}],"description":"Codes: 1 = <1 week, 2 = 1 – 2 weeks, 3 = 2 – 3 weeks, 4 = 3 – 4 weeks 5 = > 4 weeks"},"cid":"c89"},{"label":"How much did you spend on transport to and from the distribution site","field_type":"number","required":true,"field_options":{"description":"SoSh"},"cid":"c93"}]}';
   
 

$json = json_decode($str, true);

//var_dump($json);

//print_r($json['fields']);

//echo $json['fields'][0]['label'];
//echo $json['fields'][0]['field_type'];

$values = $json['fields'];

foreach($values as $key=>$value)
{
	//print_r($value['field_options']);
	
	//var_dump($value['field_options']);
	
	//echo $value['field_options']['options']['label'];
	
	
	echo $value['label'].' - '.$value['field_type'].' - '.$value['required'].'- CID:'.$value['cid'].'<br><br>';	
	echo '------------------------------<br>';
	if(empty($value['field_options']))
	{
	}
	else
	{
		//print_r($value['field_options']);	
		
		
		//echo $value['field_options']['size'];
		
		$field_options = $value['field_options'];
		
		if(empty($field_options['size']))
		{
		}
		else
		{
			echo 'Size - '.$field_options['size'];
			echo '<br><br>';
		}
		
		if(empty($field_options['description']))
		{
		}
		else
		{
			echo 'Description - '.$field_options['description'];
			echo '<br><br>';
		}
		
		if(empty($field_options['min_max_length_units']))
		{
		}
		else
		{
			echo 'min_max_length_units - '.$field_options['min_max_length_units'];
			echo '<br><br>';
		}
		
		if(empty($field_options['minlength']))
		{
		}
		else
		{
			echo 'min length - '.$field_options['minlength'];
			echo '<br><br>';
		}
		
		if(empty($field_options['maxlength']))
		{
		}
		else
		{
			echo 'max length - '.$field_options['maxlength'];
			echo '<br><br>';
		}
		
		if(empty($field_options['options']))
		{
		}
		else
		{
			//print_r($field_options['options']);
			//echo '<br><br>';
			
			echo 'Select options:<br>';
			
			$options = $field_options['options'];
			
			foreach($options as $key=>$option)
			{
				echo $option['label'].' '.$option['checked'].'<br>';
			}
			echo '<br><br>';

		}
		
		
		echo '------------------------------<br>';
		
	}
}
	?>