<?php 
/*
 * Template Name: Данные
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
                <h1>Личные данные</h1>
				<div class="profile_info" >
                        <div class="company">     
                            <p class="glav">Информация о компании</p>
                            <p>Наименование: <span><?=$my_user->company?></span></p>
                            <!-- <p>Сайт</p> -->
                            <!-- <p>Сфера деятельности: <span><?=$my_user->sphere?></span></p> -->
                            
                        </div>
                        <div class="personal">
                            <p class="glav">Личные данные</p>
                            <p>ФИО: <span><?=$my_user->fio?></span></p>
                            <!-- <p>Должность: <span><?=$my_user->job?></span></p> -->
                            <p>Контактный телефон: <span><?=$my_user->tel?></span></p>
                            <p>Электронная почта: <span><?=$my_user->email?></span></p>
                            <!-- <p>Город: <span><?=$my_user->city?></span></p> -->
                        </div>
                </div>
                 <a href="javascript;" class="change_mydata_open">Редактировать</a>
            </div>
            <div class="redaktformbg">
                <div class="redaktform">
                    <div class="contact__wrapp">
                        <div class="contact__block">
                            <div class="contact__blocktitle">
                                Изменение данных
                            </div>
                            <form class="change_mydata_form">
                                <label class="placeholder">
                                    <input class="input textup input-name" type="text" name="ФИО" value="<?=$my_user->fio?>">
                                    <span>ФИО</span>
                                </label>        
                                <label class="placeholder">
                                    <input class="input textup input-tel mask-for-input" type="text" name="Телефон" value="<?=$my_user->tel?>">
                                    <span>Телефон</span>
                                </label>       
                                <label class="placeholder">
                                    <input class="input textup input-email" type="text" name="Почта" value="<?=$my_user->email?>">
                                    <span>E-mail</span>
                                </label>     
                                <label class="placeholder">
                                    <input class="input textup input-company" type="text" name="Компания" value="<?=$my_user->company?>">
                                    <span>Компания</span>
                                </label>    
                                <label class="placeholder">
                                    <input class="input textup" type="text" name="Город" value="<?=$my_user->city?>"> 
                                    <span>Город</span>
                                </label>
                                <label class="placeholder">
                                    <input class="input textup" type="text" name="Направление" value="<?=$my_user->sphere?>">
                                    <span>Сфера деятельности</span>
                                </label>
                                <label class="placeholder">
                                    <input class="input textup" type="text" name="Должность" value="<?=$my_user->job?>">
                                    <span>Должность</span>
                                </label>

                                <input type="hidden" value="participation" name="type">
                                <button class="submit">Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                            
                            
        </div>
    </div>
</section>   
<?php
get_footer();  