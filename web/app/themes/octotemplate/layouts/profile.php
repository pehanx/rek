<?php
/*
 * Template Name: Профиль
 *
 * Template Post Type: page
 *
 * The template for displaying Profile page
 *
 * @package wptemplate
 *
 */
 ?>
            <?php include('sidebar.php') ?>
            <div class="profile_content">
                <?php if(isset($_GET['client'])):?>
                    <?php $id_client = $_GET['client']; ?>
                    
                    <?php $another_client = $wpdb->get_row( " SELECT * FROM {$table_clients} WHERE id = '$id_client' ");?>
                    <h1>Данные участника</h1>
                    <div class="profile_info">
                        <img src="<?=get_template_directory_uri()?>/static/img/avatars/<?=$another_client->avatar?>" style="width:100px; align-items:  center;">
                        <div class="company">     
                            <p class="glav">Информация о компании</p>
                            <p>Наименование: <span><?=$another_client->company?></span></p>
                            <p>Описание компании</p>
                            <p>Сайт</p>
                            <p>Сфера деятельности: <span><?=$another_client->sphere?></span></p>
                        </div>
                        <div class="personal">
                            <p class="glav">Личные данные</p>
                            <p>ФИО: <span><?=$another_client->fio?></span></p>
                            <p>Должность: <span><?=$another_client->job?></span></p>
                            <p>Контактный телефон: 
                                <a href="tel:<?=$my_user->tel?>">
                                    <span><?=$another_client->tel?></span>
                                </a>
                            </p>
                            
                            <p>Электронная почта: 
                                <a href="mailto:<?=$another_client->email?>">
                                    <span><?=$another_client->email?></span>
                                </a>
                            </p>
                            <p>Город: <span><?=$another_client->city?></span></p>
                        </div>
                    </div> 
                    <form method="post" id="send_sms">
                        <input type="hidden" name="id_client_from" value="<?=$_COOKIE['id']?>">
                        <input type="hidden" name="id_client_to" value="<?=$id_client?>">
                        <textarea class="textarea_sms" placeholder="Напишите сообщение..." id="sms_text" name="sms_text"></textarea>
                        <br>
                        <button type="submit" class="submit">Отправить</button>
                    </form>
                <?php else:?>
                <!-- <div class="navs_for_profile"> -->
                <div class="nav first_nav">
                    <div>
                        <a href='?tab=experts'>
	                        Эксперты
	                    </a>
                    </div>
                    <div>
                        <a href='?tab=materials'>
                        	Материалы
                        </a>
                    </div>
                    <!-- <div>
                        <a href='?tab=search_customer' class="search_customer_nav_element">
                        	Покупатели
                        </a>
                    </div> -->

                    <?php if(current_user_can('editor') || current_user_can('administrator')):?> 
	                   <!--  <div>
	                        <a href='?tab=inquiries' class="search_customer_nav_element">
	                        	Запросы
	                        </a>
	                    </div> -->
                	<?php endif;?>
                </div>
                	<?php 
	                	if(isset($_GET['tab'])):
		                	switch ($_GET['tab']):
		                		case 'favorites':?>
                				<!-- <div class="nav second_nav">
		                			<div>
										<a href='?tab=favorites&sub_tab=favorites_experts'>Эксперты</a>
				                	</div>
				                	<div>
				                		<a href='?tab=favorites&sub_tab=favorites_events'>События</a>
				                	</div>
				                	<div>
				                		<a href='?tab=favorites&sub_tab=favorites_materials'>Материалы</a>
				                	</div>
					                <div>
				                		<a href='?tab=favorites&sub_tab=favorites_customers'>Покупатели</a>
				                	</div>
                				</div> -->
                			<!-- </div> -->
                			<!-- navs_for_profile -->
		                		<?php break;
		                		case 'events':?>
		                		<div class="nav second_nav">
				                	<div>
				                		<a href='?tab=events&sub_tab=future_events'>События</a>
				                	</div>
				                	<div>
				                		<a href='?tab=events&sub_tab=past_events'>Прошедшие события</a>
				                	</div>
				                </div></div>
								<?php break;
								case 'search_customer':?>
									</div>
		                			<div class="my_events contact__wrapp">
				                    <div style="width: 100%">
				                    <form method="post" style="width: 100%;">
				                    	<label>
									        <label class="placeholder placeholder-active" style="margin-bottom: 0">
									          <p class="info">Где Вы хотите искать клиентов</p>
									        </label>
											<label class="placeholder" style="margin-bottom: 20px;">
					                            <select name="where_search_customers" id="where_search_select" class="input textup select" style="padding-top: 15px; padding-bottom: 15px;background-color: #EFEFEF;">
					                            <option value="">Выберите источник поиска</option>

					                            <option <?php if(@$_POST['where_search_customers'] == 'Казахстан') echo "selected"; ?>>
					                            	Казахстан</option>
					                            <option <?php if(@$_POST['where_search_customers'] == 'Киргизия') echo "selected"; ?>>
					                            	Киргизия</option>
					                            <option <?php if(@$_POST['where_search_customers'] == 'Беларусь') echo "selected"; ?>>
					                            	Беларусь</option>
					                            <option <?php if(@$_POST['where_search_customers'] == 'Индийские импортёры') echo "selected"; ?>>
					                            	Индийские импортёры</option>
					                            <option <?php if(@$_POST['where_search_customers'] == 'Индийские компании') echo "selected"; ?>>
					                            	Индийские компании</option>
					                            <option value="Lesprom" <?php if(@$_POST['where_search_customers'] == 'Lesprom') echo "selected"; ?>>
					                            	Предприятия лесной отрасли</option>
					                            <option value="Food1" <?php if(@$_POST['where_search_customers'] == 'Food1') echo "selected"; ?>>
					                            	Предприятия пищевой промышленности</option>
					                       		</select>
					                        </label>
								        </label>
										
				                        <label class="placeholder" style="margin-bottom: 20px">
				                            <input class="input textup input-name" type="text" value="<?=@$_POST['Zapros']?>" name="Zapros" id="fio_reg" style="background-color: #EFEFEF">
				                            <span style="font-size: 14px">Запрос</span>
				                            <p class="info">Введите запрос на поиск организаций</p>
				                        </label>
				                        <button class="submit">Поиск</button>
				                    </form>
				                    </div>
				                </div>
				                <div class="typical__wrapp my_events">

				                    <?php 
				                    if(isset($_POST['Zapros'])){
				                        $text_zapros = $_POST['Zapros'];
				                        if( strlen(trim($text_zapros)) > 0 ){ 
				                        	if(isset($_POST['where_search_customers'])){
				                        		$where_search = $_POST['where_search_customers'];
				                        		if($where_search == 'Казахстан'){
				                            		$id_pars = nikite($text_zapros);
				                            		nikite2($id_pars, $where_search);
				                        		}else
				                        			nikite2($text_zapros, $where_search);
				                        	}
				                        }else{
				                            echo "<script>alert('Введите запрос');</script>";
				                        }
				                    }
				                    ?>
				                </div>
								<?php break;
								case 'inquiries':?>
		                			<?php $inquiries_list = $wpdb->get_results("
		                				SELECT *
                                        FROM {$table_inquiries}");?>
			                        <?php if(!empty( $inquiries_list)):?>
			                        	<div class="my_events">
			                        	<div class="my_events contact__wrapp" style="width: auto;padding: 0;">
						                    <div style="width: 100%">
						                    <form 
						                    	method="post" 
						                    	id="form_search_inquiries_in_profile" 
						                    	style="width: 100%;">
						                            <?php 
						                            	$added = array(); 
						                            	foreach($inquiries_list as $item1):
							                            	$source = $item1->country;
								                            if( in_array($source, $added) )
								                            {
								                                continue;
								                            }
								                            $added[] = $source;
														endforeach;
													?>
													<?php 
						                            	$added1 = array(); 
						                            	foreach($inquiries_list as $item1):
							                            	$source = $item1->category;
								                            if( in_array($source, $added1) )
								                            {
								                                continue;
								                            }
								                            $added1[] = $source;
														endforeach;
													?>

												<label class="placeholder" style="margin-bottom: 20px;">
						                            <select 
						                            	name="country_search_inquiries_by_select"
						                            	id="select_country_inquiries" 
						                            	class="input textup select" 
						                            	style="padding-top: 15px; padding-bottom: 15px;background-color: #EFEFEF;">
						                            <option value="">Выберите страну запроса</option>
						                            <?php
							                        	sort($added);
														foreach($added as $element) {
														    echo "<option>".str_pad($element, 9)."</option>";
														}
							                        ?>
						                       		</select>
						                        </label>

						                        <label class="placeholder" style="margin-bottom: 20px;">
						                            <select 
						                            	name="category_search_inquiries_by_select"
						                            	id="select_category_inquiries" 
						                            	class="input textup select" 
						                            	style="padding-top: 15px; padding-bottom: 15px;background-color: #EFEFEF;">
						                            <option value="">Выберите категорию запроса</option>
						                            <?php
							                        	sort($added1);
														foreach($added1 as $element) {
														    echo "<option>".str_pad($element, 9)."</option>";
														}
							                        ?>
						                       		</select>
						                        </label>
							
						                        <label class="placeholder" style="margin-bottom: 20px">
						                            <input 
						                            class="input textup input-name" 
						                            type="text" 
						                            name="Поиск_запросов_в_базе" 
						                            id="input_search_inquiries" 
						                            style="background-color: #EFEFEF">
						                            <span style="font-size: 14px">Поиск</span>
						                        </label>
						                    </form>
						                    </div>
						                </div>
						                <div class="customer_list">
			                            <?php foreach($inquiries_list as $item):?>
			                                 <div class="my_events_block">
			                                    <p style="display: flex;justify-content: space-between;">
			                                    	<span style="width: 80%">
			                                    		<b><?=$item->category?></b>
			                                    	</span>
			                                    	<span>
			                                    		<?=$item->country;?>
			                                    	</span>
			                                    </p>
			                                    <p 
			                                    	class="event_title" 
			                                    	style="word-break: break-all;
														   margin-bottom: 10px">
													<?=$item->zapros?>		
												</p>
			                                </div>
			                            <?php endforeach;?>
			                            </div>
			                        	</div>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
	                			<?php break;
		                	endswitch;
		                endif;
					?>
                <div class="my_events">
                	<?php 
                	if(isset($_GET['tab'])):
	                	switch ($_GET['tab']):
	                		case 'experts':?>
		                			<?php $like_events_list = $wpdb->get_results("
		                				SELECT *
                                        FROM {$table_posts}
                                        inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id  
                                        WHERE id_client = '$my_id'
                                        AND post_type = 'speaker'
                                        AND post_status = 'publish' ");?>
			                        <?php if(!empty( $like_events_list)):?>
										<div class="checkbox__block checkbox_select-all-speakers">
											<div class="checkbox__input">
						                        <input type="checkbox"  id="select_all_speakers">
						                        <label for="select_all_speakers"></label>
						                    </div>
						                    <span class="checkbox__text">Выбрать всеx</span>
						                </div>

			                            <?php foreach($like_events_list as $item):?>
			                            	<div class="checkbox__block speaker-checkbox__block">
							                    <div class="checkbox__input ">
							                        <input type="checkbox" class="checkbox-speaker-profile"  id="<?=$item->ID?>">
							                        <label for="<?=$item->ID?>"></label>
							                    </div>
							                   
				                                <div class="my_events_block speaker_block">
				                                 	<a href="/speaker/<?=$item->post_name?>/">
					                                    <p><b><?=$item->post_title?></b></p>
					                                    <p 
					                                    	class="event_title" 
					                                    	style="overflow: hidden;
																   white-space: nowrap;
																   text-overflow: ellipsis;">
															<?=$item->post_content?>		
														</p>
					                                    	<a 
						                                    	class="close-form-btn delete_like_event"
						                                    	data-artid="<?=$item->ID?>"
																data_type_post = "speaker"
						                                    	>
															<div class="close-img">
																<svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
															</div>
														</a>
													</a>
				                                </div>
			                                </div>
			                            <?php endforeach;?>
			                            <a class="speaker-btn btn-blue invite-all-expert-btn" style="display: none;">
				                            Оформить заявку
				                        </a>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
				                    <a href="<?= get_permalink(PAGE_SPEAKERS_ID); ?>" class="link-page-speakers">Вернуться к экспертам →</a>
	                			<?php break;
	                		case 'future_events':?>
		                			<?php $sign_events_list = $wpdb->get_results("
		                				SELECT *, postmeta.meta_value as date_event
                                        FROM {$table_posts} as posts
                                        inner join {$table_sign_events} on {$table_sign_events}.id_post = posts.id 
                                        inner join {$table_postmeta} as postmeta on postmeta .post_id = posts.id 
                                        inner join {$table_postmeta} as postmeta1 on postmeta1 .post_id = posts.id 
                                        WHERE id_client = '$my_id' 
                                        AND postmeta.meta_key = 'event_date'
                                        AND postmeta1.meta_key = 'start_date' AND postmeta1.meta_value > date(now())
                                        ORDER BY postmeta1.meta_value");?>
			                        <?php if(!empty( $sign_events_list)):?>
			                            <?php foreach($sign_events_list as $item):?>
			                                 <div class="my_events_block">
			                                 	<a href="/event/<?=$item->post_name?>/">
				                                    <p><?=$item->date_event?></p>
				                                    <p class="event_title"><?=$item->post_title?></p>
												</a>
			                                </div>
			                            <?php endforeach;?>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
	                			<?php break;
	                		case 'materials':?>
		                			<?php $like_events_list = $wpdb->get_results("
		                				SELECT *
                                        FROM {$table_posts} 
                                        inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id  
                                        WHERE id_client = '$my_id' 
                                        AND post_type = 'material' ");?>
			                        <?php if(!empty( $like_events_list)):?>
			                            <?php foreach($like_events_list as $item):?>
			                                 <div class="my_events_block">
			                                 	<a href="/material/<?=$item->post_name?>/">
				                                    <p class="event_title"><?=$item->post_title?></p>
					                                    <a 
					                                    	class="close-form-btn delete_like_event" 
					                                    	data-artid="<?=$item->ID?>"
					                                    	data_type_post = "material"
					                                    	>
														<div class="close-img">
															<svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
														</div>
													</a>
												</a>
			                                </div>
			                            <?php endforeach;?>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
			                        <a href="<?= get_permalink(PAGE_MATERIALS_ID); ?>" class="link-page-speakers">Вернуться к материалам →</a>
	                			<?php break;
	                		case 'favorites_events':?>
		                			<?php $like_events_list = $wpdb->get_results("
		                				SELECT *
                                        FROM {$table_posts} 
                                        inner join {$table_like_events} on {$table_like_events} .id_post = {$table_posts} .id 
                                        inner join wp_postmeta on wp_postmeta.post_id = {$table_posts} .id 
                                        WHERE id_client = '$my_id' 
                                        AND meta_key = 'event_date'
                                        AND post_type = 'event' ");?>
			                        <?php if(!empty( $like_events_list)):?>
			                            <?php foreach($like_events_list as $item):?>
			                                 <div class="my_events_block">
			                                 	<a href="/event/<?=$item->post_name?>/">
				                                    <p><?=$item->meta_value?></p>
				                                    <p class="event_title"><?=$item->post_title?></p>
					                                    <a 
					                                    	class="close-form-btn delete_like_event" 
					                                    	data-artid="<?=$item->ID?>"
															data_type_post = "event"
					                                    	>
														<div class="close-img">
															<svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
														</div>
													</a>
												</a>
			                                </div>
			                            <?php endforeach;?>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
	                			<?php break;
	                		case 'favorites_customers':?>
		                			<?php $like_events_list = $wpdb->get_results("
		                				SELECT *, 
		                					{$table_add_customers}.company as customer_company,
		                					{$table_add_customers}.id as customer_id

                                        FROM {$table_add_customers} 
                                        inner join {$table_clients} on {$table_clients}.id = {$table_add_customers}.id_client
                                        WHERE id_client = '$my_id' ");?>
			                        <?php if(!empty( $like_events_list)):?>
			                        	<div class="my_events contact__wrapp" style="width: auto;padding: 0;">
						                    <div style="width: 100%">
						                    <form method="post" id="form_search_customer_in_my_baza" style="width: 100%;">
											
						                        <label class="placeholder" style="margin-bottom: 20px;">
						                            <select name="where_search_customers_by_select" id="where_search_select" class="input textup select" style="padding-top: 15px; padding-bottom: 15px;background-color: #EFEFEF;">
						                            <option value="">Выберите источник поиска</option>
							                        <?php foreach($like_events_list as $item1):
							                            	$source = $item1->where_search;
								                            if( in_array($source, $added) )
								                            {
								                                continue;
								                            }
								                            $added[] = $source;

								                            if($source == 'Lesprom'):?>
																<option value="Lesprom" <?php if(@$_POST['where_search_customers'] == $source) echo "selected"; ?>>
						                            				Предприятия лесной отрасли		
						                            			</option>
								                            <?php elseif ($source == 'Food1'):?>
								                            	<option value="Food1" <?php if(@$_POST['where_search_customers'] == $source) echo "selected"; ?>>
						                            				Предприятия пищевой промышленности
						                            			</option>
								                            <?php else:?>
																<option <?php if(@$_POST['where_search_customers'] == $source) echo "selected"; ?>>
						                            				<?=$source?>		
						                            			</option>
								                            <?php endif;?>
							                        <?php endforeach;?>
						                       		</select>
						                        </label>
							
						                        <label class="placeholder" style="margin-bottom: 20px">
						                            <input class="input textup input-name" type="text"  name="Поиск_покупателя_в_базе" id="search_customer_in_my_baza" style="background-color: #EFEFEF">
						                            <span style="font-size: 14px">Поиск</span>
						                            <p class="info">Введите запрос на поиск организаций в Вашей базе</p>
						                        </label>
						                    </form>
						                    </div>
						                </div>
						                <div class="customer_list">
			                            <?php foreach($like_events_list as $item):?>
			                                 <div class="my_events_block">
		                                 		<a href='?customer=<?=$item->customer_id?>' 
		                                 		  title='<?=$item->info?>'>
				                                    <p style="display: flex;">
				                                    	<span style="width: 80%">
				                                    		<b><?=$item->customer_company?></b>
				                                    	</span>
				                                    	<span style="text-align:right;">
				                                    		<?php if($item->where_search == 'Lesprom'):
				                                    			echo "Предприятия лесной отрасли";
				                                    		elseif($item->where_search == 'Food1'):
																echo "Предприятия пищевой промышленности";		
				                                    		else:
				                                    			echo $item->where_search;		
				                                    		endif;?>
				                                    	</span>
				                                    </p>
				                                    <p 
				                                    	class="event_title" 
				                                    	style="overflow: hidden;
															   white-space: nowrap;
															   text-overflow: ellipsis;
															   margin-bottom: 10px">
														<?=$item->info?>		
													</p>
													<?php if($item->note):?>
														<p class="customer_note" style="font-size: 13px;margin-bottom: 0; font-weight: 500">
															Комментарий:
														</p>
														<p class="customer_note">
															<?=$item->note?>		
														</p>
													<?php endif;?>
														<p class="customer_note" style="font-size: 13px; margin-bottom:0; font-weight: 500">
															Запрос:
														</p>
														<p class="customer_note">
															<?=$item->zapros?>		
														</p>
					                                    <a 
					                                    	class="close-form-btn delete_like_customer"
					                                    	data-artid="<?=$item->customer_id?>"
					                                    	>
														<div class="close-img">
															<svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
														</div>
													</a>
												</a>
			                                </div>
			                            <?php endforeach;?>
			                            </div>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
	                			<?php break;
	                		case 'past_events':?>
								<?php $like_events_list = $wpdb->get_results("
									SELECT *, postmeta.meta_value as date_event
                                    FROM {$table_posts} as posts
                                    inner join {$table_sign_events} on {$table_sign_events}.id_post = posts.id 
                                    inner join {$table_postmeta} as postmeta on postmeta .post_id = posts.id 
                                    inner join {$table_postmeta} as postmeta1 on postmeta1 .post_id = posts.id 
                                    inner join {$table_postmeta} as postmeta2 on postmeta2 .post_id = posts.id 
                                    WHERE id_client = '$my_id' 
                                    AND postmeta.meta_key = 'event_date' 
                                    AND postmeta1.meta_key = 'start_date' AND postmeta1.meta_value < date(now()) 
                                    AND postmeta2.meta_key = 'end_date' AND postmeta2.meta_value < date(now())");?>
			                        <?php if(!empty( $like_events_list)):?>
			                            <?php foreach($like_events_list as $item):?>
											<div class="my_events_block">
			                                 	<a href="/event/<?=$item->post_name?>/">
				                                    <p><?=$item->date_event?></p>
				                                    <p class="event_title"><?=$item->post_title?></p>
												</a>
			                                </div>
			                            <?php endforeach;?>
			                        <?php else: ?>
			                            <h1>Ничего не найдено</h1>
			                        <?php endif; ?>
	                			<?php break;	       		
	                	endswitch;
	                elseif(isset($_GET['customer'])):

	                	$id_customer = $_GET['customer']; 
	                	$customer_list = $wpdb->get_row("

        				SELECT *, 
        					{$table_add_customers}.company as customer_company,
        					{$table_add_customers}.id as customer_id,
        					{$table_add_customers}.email as mail
                        FROM {$table_add_customers} 
                        inner join {$table_clients} on {$table_clients}.id = {$table_add_customers}.id_client
                        WHERE {$table_add_customers}.id_client = '$my_id' 
                          AND {$table_add_customers}.id = '$id_customer' ");?>
                            <div class="my_events_block">
                            	<div class="contact__wrapp show_add_note_customer" 
                            		style="
	                            	width: auto;
								    margin-bottom: 30px;
								    border-bottom: 1px solid #0E8EAB;
								    padding-bottom: 20px;
								    display: none;"> 
			                    <form method="post" class="form_add_note_customer" style="width: 100%;">
			                    	<label class="placeholder" style="margin-bottom: 10px">
				                        <textarea class="textarea textup input-text" name="Пометка_покупателя"><?=$customer_list->note?></textarea>
				                        <span>Ваши комментарии к этому покупателю</span>
				                    </label>
				                    <input type="hidden" name="id_add_customer" value="<?=$customer_list->customer_id?>">
			                        <button 
			                        	class="submit" 
			                        	style="height: auto;
											   padding: 0 12px;
											   font-size: 13px;
											   line-height: 40px;">
										Сохранить
									</button>
			                    </form>
			                    </div>
                                <p>
                                	<b><?=$customer_list->customer_company?></b>
                                	<a class="close-form-btn change_like_customer" data-artid="<?=$customer_list->customer_id?>" style="float: right;position: static;">
										<svg class="icon__up" width="20px" height="18px">
									        <use xlink:href="#icon-pencil"></use>
									    </svg>
									</a>
                                </p>
                                <p class="customer_title" style="-ms-user-select: none; -moz-user-select: none; -webkit-user-select: none; user-select: none;word-wrap: break-word;">
									<?=$customer_list->info?>		
								</p>
								<br>
								<p style="font-weight: 500;">Контакты:</p>
					            <p style="word-wrap: break-word;">
					            <?php
					            	if(!empty($customer_list->phone)) 
					            		echo "<span class='contacts'>Телефон:</span> ".$customer_list->phone."<br>";
					            	if(!empty($customer_list->mail))
			            	   			echo "<span class='contacts'>E-mail:</span> " .$customer_list->mail."<br>";
					            	if(!empty($customer_list->address)) 
					            		echo "<span class='contacts'>Адрес:</span> "  .$customer_list->address."<br>";
					            	if(!empty($customer_list->site) && strlen($customer_list->site)>3) 
					            		echo "<span class='contacts'>Сайт:</span> <a style='color: #0E8EAB;' target='_blanck' href='//$customer_list->site'>".$customer_list->site."</a><br>";
					            	if(!empty($customer_list->category)) 
			            				echo "<span class='contacts'>Категория:</span> "  .$customer_list->category."<br>";
			            			if(!empty($customer_list->country)) 
			            				echo "<span class='contacts'>Страна:</span> "  .$customer_list->country."<br>";
			            			if(!empty($customer_list->workers)) 
			            				echo "<span class='contacts'>Сотрудники компании:</span><br>"  .$customer_list->workers."<br>";
					            	if(!empty($customer_list->contacts))
					            	    echo "<span class='contacts'>Другое:</span> " .$customer_list->contacts."<br>";

					            	$arr_contacts = array(
					            		0,
					            		$customer_list->contact1,
					            		$customer_list->contact2,
					            		$customer_list->contact3,
					            		$customer_list->contact4,
					            		$customer_list->contact5,
					            		$customer_list->contact6,
					            		$customer_list->contact7
					            	);

					            	$j = 0;
					            	for ($i = 1; $i < 8; $i++) { 
					            		if(!empty($arr_contacts[$i])){
					            			$j++;
					            			echo $j.". ".$arr_contacts[$i]."<br>";
					            		}
					            	}    
								?>
					            </p>

								<?php if($customer_list->note):?>
									<br>
									<p class="customer_note" style="font-size: 13px; font-weight: 500;margin-bottom: 0">
										Комментарий:
									</p>
									<p class="customer_note note_change" style="white-space: normal;">
										<?=$customer_list->note?>		
									</p>
								<?php endif;?>
									<p class="customer_note" style="font-size: 13px; margin-bottom:0; font-weight: 500">
										Запрос:	
									</p>
									<p class="customer_note">
										<?=$customer_list->zapros?>		
									</p>
									<p class="customer_note" style="font-size: 13px; margin-bottom:0; font-weight: 500">
										Откуда осуществлялся поиск:	
									</p>
									<p class="customer_note">
										<?=$customer_list->where_search?>		
									</p>
                                    <a 
                                    	class="close-form-btn delete_like_customer_select"
                                    	data-artid="<?=$customer_list->customer_id?>"
                                    	>
										<div class="close-img">
											<svg viewBox="-5 -5 50 50"><path style="stroke: #fff; fill: transparent; stroke-width: 5;" d="M 10,10 L 30,30 M 30,10 L 10,30"></path></svg>
										</div>
									</a>
                            </div>
                            <?php 
                	endif;?>  
                </div>
            <?php endif;?>
            </div>
        </div>
    </div>
</section>   
<?php
get_footer(); 

 function nikite($zapros){ // функция запуска поиска
        // $query = $_POST['Zapros']; //Запрос
        $query = $zapros;
        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5'; //токен
        $link = "http://176.99.5.64/upapi/kzshow&q=$query";
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $html = curl_exec($curl);
        $html = strip_tags($html);
        preg_match('/(.*)/',$html,$mark);
        $parser_id = $mark[0]; // id запроса, который лучше хранить в базе
        return $parser_id;
    }
    function nikite2($mark_kz,$where_search){ // функция просмотра поиска, где $mark_kz - Это $parser_id из прошлой функции, а $page - это номер страницы, например начнём с первой (1)

        // $mark_kz = "ADCEEACCAICEIAJ";

        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5';

    switch ($where_search) {
    	case 'Казахстан':
    		$link = "http://176.99.5.64/upapi/kzopen&m=$mark_kz"; //Казахстан
    		break;
    	case 'Киргизия':
    		$link = "http://176.99.5.64/upapi/kgshow&q=$mark_kz"; //Киргизия
    		break;
    	case 'Беларусь':
    		$link = "http://176.99.5.64/upapi/itshow&q=$mark_kz"; //Беларусь
    		break;
    	case 'Индийские импортёры':
    		$link = "http://176.99.5.64/upapi/indshow&q=$mark_kz"; //Индийские импортёры
    		break;
    	case 'Индийские компании':
    		$link = "http://176.99.5.64/upapi/niirshow&q=$mark_kz"; //Индийские компании
    		break;
    	case 'Lesprom':
    		$link = "http://176.99.5.64/upapi/lpshow&q=$mark_kz"; //Lesprom
    		break;
    	case 'Food1':
    		$country = 'ALL';
    		$link = "http://176.99.5.64/upapi/ofshow&q=$mark_kz&c=$country"; //Food1
    		break;
    }

        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 4);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $html = curl_exec($curl);
        $html = strip_tags($html);

        switch ($where_search) {
	    	case 'Lesprom':
	    		preg_match('/(.*)/',$html,$mark);
		        $markkz = $mark[0];
		        $authtoken = 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODAwMjVjYzA1OWE3ZmY1NDk0MmVjMGNlNDZjNDJmZGVhYTc5ZDU5';
		        $link = "http://176.99.5.64/upapi/lpopen&m=$markkz";
		        $curl = curl_init($link);
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Host: spider.g2r.su',$authtoken));
		        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		        $html = curl_exec($curl);
	    		break;
	    }

        $html = json_decode($html,true);
        if($html == null) {
        	echo "<p>Ничего не найдено, попробуйте другой запрос</p>";
        }else{


        echo "<p>Всего найдено организаций - ".count($html)."</p>";
        $i = 0;
        require_once 'wp/wp-load.php';
		global $wpdb;
		$table_add_customers = $wpdb->get_blog_prefix() . 'add_customers';
		$my_id   = $_SESSION['user_id'];

        	 switch ($where_search) {
		    	case 'Казахстан':
		    	foreach($html as $html){
		    		 $array_html = array(
		                $html['contact1'],
		                $html['contact2'],
		                $html['contact3'],
		                $html['contact4'],
		                $html['contact5'],
		                $html['contact6'],
		                $html['contact7'],
		            );

		            $company = $html['company'] ;  
		            $info    = $html['info']; 

		            $company = str_replace('\"','"',$company);
		            $company = str_replace('"','',$company);
		            $info    = str_replace('\"','"',$info);
		            $info    = str_replace('"','',$info);

		            ?>

		            <p style="word-wrap: break-word;"><b><?=$html['company']?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
		            <?php
		                $i = 0;
		                $arr_not_empty_contacts = array(
		                    0
		                );
		                foreach ($array_html as $item):
		                    if($item == 'не указан' || empty($item)) continue;
		                    $i++;
		                    echo $i.". ".$item."<br>";
		                    array_push($arr_not_empty_contacts, $item);
		                endforeach;?>
		            </p>
		            <?php 
		                $data_contact1 = @$arr_not_empty_contacts[1];
		                $data_contact2 = @$arr_not_empty_contacts[2];
		                $data_contact3 = @$arr_not_empty_contacts[3];
		                $data_contact4 = @$arr_not_empty_contacts[4];
		                $data_contact5 = @$arr_not_empty_contacts[5];
		                $data_contact6 = @$arr_not_empty_contacts[6];
		                $data_contact7 = @$arr_not_empty_contacts[7];
		            ?>
		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['info']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['info']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_company   = "<?=$company;?>" 
		                            data_info	   = "<?=$info;?>"
		                            data_zapros    = "<?=$data_zapros;?>"
		                            data_contact1  = "<?=$data_contact1;?>"
		                            data_contact2  = "<?=$data_contact2;?>"
		                            data_contact3  = "<?=$data_contact3;?>"
		                            data_contact4  = "<?=$data_contact4;?>"
		                            data_contact5  = "<?=$data_contact5;?>"
		                            data_contact6  = "<?=$data_contact6;?>"
		                            data_contact7  = "<?=$data_contact7;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_company   = "<?=$company;?>" 
		                            data_info	   = "<?=$info;?>"
		                            data_zapros    = "<?=$data_zapros;?>"
		                            data_contact1  = "<?=$data_contact1;?>"
		                            data_contact2  = "<?=$data_contact2;?>"
		                            data_contact3  = "<?=$data_contact3;?>"
		                            data_contact4  = "<?=$data_contact4;?>"
		                            data_contact5  = "<?=$data_contact5;?>"
		                            data_contact6  = "<?=$data_contact6;?>"
		                            data_contact7  = "<?=$data_contact7;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php
		            }
		    		break;
		    	case 'Киргизия':
		    	foreach($html as $html){

		            $company = $html['name'];  
		            $info    = $html['info'];
		            $phone   = $html['phone'];
		            $mail    = $html['mail'];
		            $address = $html['address'];

		            $company = str_replace('\"','"',$company);$company = str_replace('"','',$company);
		            $info = str_replace('\"','"',$info);$info = str_replace('"','',$info);
		            $phone = str_replace('\"','"',$phone);$phone = str_replace('"','',$phone);
		            $mail = str_replace('\"','"',$mail);$mail = str_replace('"','',$mail);
		            $address = str_replace('\"','"',$address);$address = str_replace('"','',$address);

		            ?>

		            <p style="word-wrap: break-word;"><b><?=$company?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
			            <?php
			            	if(!empty($phone)) 
			            		echo "<span class='contacts'>Телефон:</span> ".$phone."<br>";
			            	if(!empty($mail))
			            	    echo "<span class='contacts'>E-mail:</span> " .$mail."<br>";
			            	if(!empty($address)) 
			            		echo "<span class='contacts'>Адрес:</span> "  .$address."<br>";
			            ?>
		            </p>
		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['info']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['info']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail      	  = "<?=$mail;?>"
		                            data_address   	  = "<?=$address;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail         = "<?=$mail;?>"
		                            data_address   	  = "<?=$address;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php
		            }
		    		break;
		    	case 'Беларусь':
		    		foreach($html as $html){

		            $company  = $html['title'];  
		            $info     = $html['info'];
		            $phone    = $html['phone'];
		            $mail     = $html['mail'];
		            $address  = $html['address'];
		            $category = $html['category'];

		            $company = str_replace('\"','"',$company);$company = str_replace('"','',$company);
		            $info = str_replace('\"','"',$info);$info = str_replace('"','',$info);
		            $phone = str_replace('\"','"',$phone);$phone = str_replace('"','',$phone);
		        	$phone = "";
		            $mail = str_replace('\"','"',$mail);$mail = str_replace('"','',$mail);
		            $address = str_replace('\"','"',$address);$address = str_replace('"','',$address);
		            $category = str_replace('\"','"',$category);$category = str_replace('"','',$category);?>

		            <p style="word-wrap: break-word;"><b><?=$company?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
			            <?php
			            	if(!empty($phone)) 
			            		echo "<span class='contacts'>Телефон:</span> ".$phone."<br>";
			            	if(!empty($mail))
			            	    echo "<span class='contacts'>E-mail:</span> " .$mail."<br>";
			            	if(!empty($address)) 
			            		echo "<span class='contacts'>Адрес:</span> "  .$address."<br>";
			            	if(!empty($category)) 
			            		echo "<span class='contacts'>Категория:</span> "  .$category."<br>";
			            ?>
		            </p>
		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['info']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['info']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail      	  = "<?=$mail;?>"
		                            data_address   	  = "<?=$address;?>"
		                            data_category     = "<?=$category;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail         = "<?=$mail;?>"
		                            data_address   	  = "<?=$address;?>"
		                            data_category     = "<?=$category;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php
		            }
		    		break;
		    	case 'Индийские импортёры':
		    		foreach($html as $html){

		            $company  = $html['firm'];  
		            $info     = $html['description'];
		            $phone    = $html['phone'];
		            $mail     = $html['mail'];
		            $address  = $html['location'];
		            $site 	  = $html['site'];

		            $company = str_replace('\"','"',$company);$company = str_replace('"','',$company);
		            $info = str_replace('\"','"',$info);$info = str_replace('"','',$info);
		            $phone = str_replace('\"','"',$phone);$phone = str_replace('"','',$phone);
		        	$phone = "";
		            $mail = str_replace('\"','"',$mail);$mail = str_replace('"','',$mail);
		            $address = str_replace('\"','"',$address);$address = str_replace('"','',$address);
		            // $site = str_replace('\"','"',$site);$site = str_replace('"','',$site);

		            ?>

		            <p style="word-wrap: break-word;"><b><?=$company?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
			            <?php
			            	if(!empty($phone)) 
			            		echo "<span class='contacts'>Телефон:</span> ".$phone."<br>";
			            	if(!empty($mail))
			            	    echo "<span class='contacts'>E-mail:</span> " .$mail."<br>";
			            	if(!empty($address)) 
			            		echo "<span class='contacts'>Адрес:</span> "  .$address."<br>";
			            	if(!empty($site) && strlen($site)>3) 
			            		echo "<span class='contacts'>Сайт:</span> <a style='color: #0E8EAB;' target='_blanck' href='//$site'>".$site."</a><br>";
			            ?>
		            </p>

		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['description']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['description']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail      	  = "<?=$mail;?>"
		                            data_address   	  = "<?=$address;?>"
		                            data_site     	  = "<?=$site;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail         = "<?=$mail;?>"
		                            data_address   	  = "<?=$address;?>"
		                            data_site     	  = "<?=$site;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php
		            }
		    		break;
		    	case 'Индийские компании':
		    		foreach($html as $html){

		            $company  = $html['name'];  
		            $phone    = $html['phone'];
		            $site 	  = $html['site'];
		            $contacts = $html['contacts'];
		            $info 	  = $html['info'];
		            $address  = $html['address'];
		            $category = $html['category'];

		            $company = str_replace('\"','"',$company);$company = str_replace('"','',$company);
		            // $info = str_replace('\"','"',$info);
		            $info = str_replace('"','',$info);
		            $phone = str_replace('\"','"',$phone);$phone = str_replace('"','',$phone);
		            $contacts = str_replace('\"','"',$contacts);$contacts = str_replace('"','',$contacts);
		            $address = str_replace('\"','"',$address);$address = str_replace('"','',$address);
		            $category = str_replace('\"','"',$category);$category = str_replace('"','',$category);

		            ?>

		            <p style="word-wrap: break-word;"><b><?=$company?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
			            <?php
			            	if(!empty($phone)) 
			            		echo "<span class='contacts'>Телефон:</span> ".$phone."<br>";
			            	if(!empty($address)) 
			            		echo "<span class='contacts'>Адрес:</span> "  .$address."<br>";
			            	if(!empty($site) && strlen($site)>3) 
			            		echo "<span class='contacts'>Сайт:</span> <a style='color: #0E8EAB;' target='_blanck' href='//$site'>".$site."</a><br>";
			            	if(!empty($contacts))
			            	    echo "<span class='contacts'>Другое:</span> " .$contacts."<br>";
			            ?>
		            </p>

		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['info']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['info']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_address   	  = "<?=$address;?>"
		                            data_site     	  = "<?=$site;?>"
		                            data_contacts     = "<?=$contacts;?>"
		                            data_category     = "<?=$category;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_address   	  = "<?=$address;?>"
		                            data_site     	  = "<?=$site;?>"
		                            data_contacts     = "<?=$contacts;?>"
		                            data_category     = "<?=$category;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php
		            }
		    		break;
		    	case 'Lesprom':
		    		foreach($html as $html){

		            $company  = $html['company']['name'];  
		            $info     = $html['company']['info'];
		            $phone    = $html['company']['phone'];
		            $mail     = $html['company']['mail'];
		            $site 	  = $html['company']['site'];
		            $country  = $html['company']['country'];

		            $company = str_replace('\"','"',$company);$company = str_replace('"','',$company);
		            $info = str_replace('\"','"',$info);$info = str_replace('"','',$info);
		            $phone = str_replace('\"','"',$phone);$phone = str_replace('"','',$phone);
		            $mail = str_replace('\"','"',$mail);$mail = str_replace('"','',$mail);

		            ?>

		            <p style="word-wrap: break-word;"><b><?=$company?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
			            <?php
			            	if(!empty($phone)) 
			            		echo "<span class='contacts'>Телефон:</span> ".$phone."<br>";
			            	if(!empty($mail))
			            	    echo "<span class='contacts'>E-mail:</span> " .$mail."<br>";
			            	if(!empty($site) && strlen($site)>3) 
			            		echo "<span class='contacts'>Сайт:</span> <a style='color: #0E8EAB;' target='_blanck' href='//$site'>".$site."</a><br>";
			            	if(!empty($country))
			            	    echo "<span class='contacts'>Страна:</span> " .$country."<br>";
			            	$count_workers = 0;
			            	foreach ($html['workers'] as $works) {
			            		if(!empty($works['name']))
			            			$count_workers++;
			            	}
			            	if($count_workers>0){
			            		$workers = "";
			            		echo "<span class='contacts'>Сотрудники компании:</span><br>";
				            	foreach ($html['workers'] as $works) {
				                    $name_work  = $works['name'];
				                    $phone_work = $works['phone'];
				                    if(!empty($name_work)){
				                    	echo "Имя: ".$name_work;
				                    	$workers .= "Имя: ".$name_work;
				                    	if(!empty($phone_work)){
				                    		echo "; телефон: ".$phone_work."<br>";
				                    		$workers .= "; телефон: ".$phone_work."<br>";
				                    	} 
				                    	else {
				                    		echo "<br>";
				                    		$workers .= "<br>";
				                    	}
				                    }
				                }
				            }
			            ?>
		            </p>

		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['company']['info']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['company']['info']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail      	  = "<?=$mail;?>"
		                            data_site     	  = "<?=$site;?>"
		                            data_country      = "<?=$country;?>"
		                            data_workers      = "<?=$workers;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_mail         = "<?=$mail;?>"
		                            data_site     	  = "<?=$site;?>"
		                            data_country      = "<?=$country;?>"
		                            data_workers      = "<?=$workers;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php
		            }
		    		break;
		    	case 'Food1':
		    		?>
	
		    		<!-- <div class="contact__wrapp" style="width: 100%;padding: 0px">
                    <div style="width: 100%">
                    <form method="post">
                    	<?php $json = json_encode($html); ?>
                    	<script type="text/javascript">
					    	var json_html_food1 = <?php echo $json; ?>
					   	</script>
			    		<label class="placeholder" style="margin-bottom: 20px;">
	                        <select name="Местоположение" id="country_food1" class="input textup select" style="padding-top: 15px; padding-bottom: 15px;background-color: #EFEFEF">
	                        <option value="">Выберите страну</option> -->
	                    <?php
	        //             foreach($html as $sas){
			    		// 	$country1 = $sas['country'];
	        //                 if(empty($country1))
	        //                     continue;

	        //                 if( in_array($country1, $added) )
	        //                 {
	        //                     continue;
	        //                 }

	        //                 $added[] = $country1;
	        //                 echo "<option>".$country1."</option>";
			    		// }
			    		?>
	                   <!--  </select>
	                    </label>
	                </form>
		            </div>
		        	</div> -->
					
					<div class="company_list">
                    <?php

		    		foreach($html as $html){

		            $company  = $html['name'];  
		            $info     = $html['info'];
		            $phone    = $html['phone'];
		            $site 	  = $html['site'];
		            $country  = $html['country'];

		            $company = str_replace('\"','"',$company);$company = str_replace('"','',$company);
		            $info = str_replace('\"','"',$info);$info = str_replace('"','',$info);
		            $phone = str_replace('\"','"',$phone);$phone = str_replace('"','',$phone);

		            ?>
					
		            <p style="word-wrap: break-word;"><b><?=$company?></b></p>
		            <p style="font-weight: 500;">Контакты:</p>
		            <p style="word-wrap: break-word;">
			            <?php
			            	if(!empty($phone)) 
			            		echo "<span class='contacts'>Телефон:</span> ".$phone."<br>";
			            	if(!empty($site) && strlen($site)>3) 
			            		echo "<span class='contacts'>Сайт:</span> <a style='color: #0E8EAB;' target='_blanck' href='//$site'>".$site."</a><br>";
			            	if(!empty($country))
			            	    echo "<span class='contacts'>Страна:</span> " .$country."<br>";
			            ?>
		            </p>

		            <span class="view_more_block"> 
		                <div>
		                    <a class="view_more_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>
		                    </a>    
		                </div>
		                <p style="font-weight: 500;">О компании:</p>
		                <p><?=$html['info']?></p>
		            </span>
		            <span class="view_less_block" style="display: none;">
		                <p><?=$html['info']?></p>
		                <p>
		                    <a class="view_less_link" href='javascript:;'>
		                        <svg class="icon__up" width="16px" height="16px">
		                            <use xlink:href="#up"></use>
		                        </svg>меньше
		                    </a>
		            <?php
		                $have_check_customer = $wpdb->get_row("
		                        SELECT * 
		                        FROM {$table_add_customers} 
		                        WHERE `id_client` = '$my_id'  
		                        AND `company` = '$company'
		                        ");?>
							<span class="add_customer_or_delete_customer">
		                    <?php if(empty($have_check_customer)):?>
		                        <?php $data_zapros = $_POST['Zapros'];?>
		                        <a 
		                            class="add_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_country      = "<?=$country;?>"
		                            data_site     	  = "<?=$site;?>"

		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>добавить
		                        </a>
		                    <?php else:?>
		                        <a 
		                            class="delete_customer" 
		                            href='javascript:;' 
		                            data_where_search = "<?=$where_search?>"
		                            data_zapros    	  = "<?=$data_zapros;?>"
		                            data_company   	  = "<?=$company;?>" 
		                            data_info	   	  = "<?=$info;?>"
		                            data_phone     	  = "<?=$phone;?>"
		                            data_country      = "<?=$country;?>"
		                            data_site     	  = "<?=$site;?>"
		                            >
		                            <svg class="icon__up" width="12px" height="12px">
		                                <use xlink:href="#icon_plus"></use>
		                            </svg>убрать
		                        </a>
		                    <?php endif;?>
		                    </span>
		                </p>
		            </span>
		            <div style='border-bottom: 1px solid #BACCFF;'></div>
		            <?php } ?>
		            </div>
		            <?php
		    		break;
		    			
		    	}
		}

    }
?>
   
