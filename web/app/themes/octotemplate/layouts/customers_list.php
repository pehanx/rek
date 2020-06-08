<?php
/*
 * Template Name: Список покупателей
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
                <div class="nav">
                    <!-- <div>
                        <a href='?my_event=future_events' style="cursor: pointer;">Предстоящие мероприятия</a>
                    </div> -->
                    <div>
                        <a href='javascript:;' style="cursor: pointer;">Избранное</a>
                    </div>
                  <!--   <div>
                        <a href='?my_event=past_events' style="cursor: pointer;">Прошедшие мероприятия</a>  
                    </div> -->
                </div>
                <div class="nav">
                	<div>
						<a href='?my_event=favorites_news' style="cursor: pointer;">Новости</a>
                	</div>
                	<div>
                		<a href='?my_event=favorites_events' style="cursor: pointer;">События</a>
                	</div>
                	<div>
                		<a href='?my_event=favorites_materials' style="cursor: pointer;">Материалы</a>
                	</div>
                	<?php if(current_user_can('editor') || current_user_can('administrator')):?> 
		                <div style="background-color: #EFEFEF;">
	                		<a href='?my_event=favorites_customers' style="cursor: pointer;">Покупатели</a>
	                	</div>
		            <?php endif;?>
                	
                </div>
                <div class="my_events">
                	<?php 
                	if(isset($_GET['my_event'])):
                        switch ($_GET['my_event']):
	                		case 'favorites_customers':?>
	                			<?php $like_events_list = $wpdb->get_results("
	                				SELECT *, 
	                					{$table_add_customers}.company as customer_company,
	                					{$table_add_customers}.id as customer_id

                                    FROM {$table_add_customers} 
                                    inner join {$table_clients} on {$table_clients}.id = {$table_add_customers}.id_client
                                    WHERE id_client = '$my_id' ");?>
		                        <?php if(!empty( $like_events_list)):?>
		                            <?php foreach($like_events_list as $item):?>
		                                 <div class="my_events_block">
		                                 	<a href="/event/<?=$item->id?>/">
			                                    <p><b><?=$item->customer_company?></b></p>
			                                    <p 
			                                    	class="event_title" 
			                                    	style="overflow: hidden;
														   white-space: nowrap;
														   text-overflow: ellipsis;">
													<?=$item->info?>		
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
		                        <?php else: ?>
		                            <h1>Ничего не найдено</h1>
		                        <?php endif; ?>
                			<?php break;	                		
	                	endswitch;
                	endif;?>  
                </div>
            <?php endif;?>
            </div>
        </div>
    </div>
</section>   
<?php
get_footer();  
   
