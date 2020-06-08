<?php
/*
 * Template Name: Запросы
 *
 * Template Post Type: page
 *
 * The template for displaying Contacts page
 *
 * @package wptemplate
 *
 */
get_header();
?>
<?php
  require_once 'wp/wp-load.php';
  global $wpdb;
  $table_clients = $wpdb->get_blog_prefix() . 'clients';
  $table_visits_clients = $wpdb->get_blog_prefix() . 'visits_clients';
  $table_inquiries = $wpdb->get_blog_prefix() . 'inquiries';

?>
<style>
  .form_members{
    flex-direction: row !important;  
    align-items: start !important;
  }
  .btn{
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 13px;
    font-weight: 600;
    overflow: hidden;
    text-decoration: none;
  }
  .btn svg{
    width: 20px;
    height: 20px;
    vertical-align: top;
    margin-top: 0;
    margin-left: 2px;
    fill: #555;
    transition: transform .2s linear;
    transform-origin: 10px 10px;
  }
  .rotate_svg{
    transform: rotate(180deg);
  }
  
  @media only screen and (max-width: 600px){
    .form_members{
      flex-direction: column; 
    }

  }
</style>
<section class="news__titleblock" style="padding-bottom: 20px;">
  <div class="contact__title">
     Запросы
  </div>
  <div class="contact__wrapp" style="display: block;">
    <button type="button" class="btn show_mail_to_clients_btn">Добавить новый запрос<svg class="rotate_svg"><use xlink:href="#up"></use></svg>
    </button>
  <div style="border-bottom: 1px solid #BACCFF; margin: 18px 0;"></div>
    <div class="contact__block show_form_mail_to_clients" style="max-width: 400px;
    margin: 0 auto 30px; padding: 30px; width: auto; display: none;">                          
      <form id="form_add_zapros">
        <label class="placeholder">
            <input class="input textup input-text" type="text" name="Имя">
            <span>Введите имя</span>
        </label>
        <label class="placeholder">
            <input class="input textup" type="text" name="Страна">
            <span>Введите страну запроса</span>
        </label>
        <label class="placeholder">
            <input class="input textup" type="text" name="Контакты">
            <span>Введите контакты запроса</span>
        </label>
        <label class="placeholder">
            <textarea class="textarea textup input-text" name="Запрос"></textarea>
            <span>Введите текст запроса</span>
        </label>
         <label style="margin-bottom: 20px">
        <label class="placeholder placeholder-active" style="margin-bottom: 0">
          <p class="info">Категория</p>
        </label>
        <div class="checkbox-list" id="clients_checkbox_list">
            <div style="display: flex; align-items: center;">
                <input value="Продукты питания" type="radio" name="Категория" class="regular-checkbox" checked />
                <span>Продукты питания</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Легкая промышленность" type="radio" name="Категория" class="regular-checkbox" />
                <span>Легкая промышленность</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Строительные товары" type="radio" name="Категория" class="regular-checkbox" />
                <span>Строительные товары</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Транспорт, техника, запчасти, инструменты" type="radio" name="Категория" class="regular-checkbox" />
                <span>Транспорт, техника, запчасти, инструменты</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Сырьё" type="radio" name="Категория" class="regular-checkbox" />
                <span>Сырьё</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Химическая промышленность" type="radio" name="Категория" class="regular-checkbox" />
                <span>Химическая промышленность</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Сельское хозяйство" type="radio" name="Категория" class="regular-checkbox" />
                <span>Сельское хозяйство</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Лесная промышленность" type="radio" name="Категория" class="regular-checkbox" />
                <span>Лесная промышленность</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Оборудование" type="radio" name="Категория" class="regular-checkbox" />
                <span>Оборудование</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Расходные материалы" type="radio" name="Категория" class="regular-checkbox" />
                <span>Расходные материалы</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Другое" type="radio" name="Категория" class="regular-checkbox" />
                <span>Другое</span>
            </div>
        </div>
        </label>
        <button class="submit">Отправить</button>
      </form>
    </div>
  </div>
  
  <div class="contact__wrapp" style="display: block;">
    <button type="button" class="btn show_settings_search_clients_btn">Инструменты поиска<svg class="rotate_svg"><use xlink:href="#up"></use></svg>
  </button>
  
  <div style="border-bottom: 1px solid #BACCFF; margin: 18px 0;"></div>
    <div class="contact__block show_form_show_clients" style="margin-bottom: 0px; padding: 30px; width: auto; display: none;">                          
    <form class="form_members" id="form_show_clients">
        
        <label style="margin-right: 20px">
        <label class="placeholder placeholder-active" style="margin-bottom: 0;">
            <p class="info">Введите текст для поиска</p>
        </label>
        <input 
          class="input textup input-name" 
          type="text" name="Поиск" 
          id="clients_input_search" 
          placeholder="Поиск" 
          style="padding-top: 10px">
        </label>
        
        <label style="margin-right: 20px">
        <label class="placeholder placeholder-active" style="margin-bottom: 0;">
            <p class="info">Регион участника клуба</p>
        </label>
            <select name="Регион" id="region_clients" class="input textup select" style="padding-top: 15px; padding-bottom: 15px; margin-bottom: 20px">
             <option value=''>Выберите регион</option>
              <?php
                $all_regions_clients = $wpdb->get_results("SELECT * FROM {$table_clients}");
                foreach ($all_regions_clients as $item):
                  if(empty($item->region))
                      continue;
                  $regions = $item->region;

                  if( in_array($regions, $added) )
                  {
                      continue;
                  }

                  $added[] = $regions;
                  echo "<option>".$regions."</option>";
                endforeach;?>
          </select>
        </label>
        
        <label style="margin-bottom: 0">
        <label class="placeholder placeholder-active" style="margin-bottom: 0">
          <p class="info">Тип участия в клубе</p>
        </label>
        <div class="checkbox-list" id="clients_checkbox_list">
            <div style="display: flex; align-items: center;">
                <input value="Экспортёр" type="checkbox" name="show_typeParty[]" class="regular-checkbox" />
                <span>Экспортёр</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Партнёр" type="checkbox" name="show_typeParty[]" class="regular-checkbox" />
                <span>Партнёр</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Спикер" type="checkbox" name="show_typeParty[]" class="regular-checkbox" />
                <span>Спикер</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Инвестор" type="checkbox" name="show_typeParty[]" class="regular-checkbox" />
                <span>Инвестор</span>
            </div>
            <div style="display: flex; align-items: center;">
                <input value="Покупатель" type="checkbox" name="show_typeParty[]" class="regular-checkbox" />
                <span>Покупатель</span>
            </div>
        </div>
        </label>
        <input 
          type="hidden" 
          class="order_field_show_clients" 
          name="order_field"
          value="">
    </form>
    </div>

	<div>
		<button type="button" class="btn btn_speakers">Оставить заявку</button>
	</div>
    
    </div>
</section>
<section class="typical" style="margin-top: 70px;">
  <style>
      #customers {
        border-collapse: collapse;
        width: 100%;
      }

      #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #customers tr:nth-child(even){background-color: #f2f2f2;}

      #customers tr:hover {background-color: #ddd;cursor: pointer;}

      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #3465E2;
        color: white;
      }

      #customers td a{
        color: #0E8EAB;
        text-decoration: none;
      }
      #customers th a{
        color:#fff;
        text-decoration: none;
      }
      #customers th a:hover{
        text-decoration: underline;
      }


      </style>
  <div class="typical__wrapp1" style="position: relative; padding:50px 0;width: calc(100% - 50px);margin: 0 auto;overflow-x: auto;" >
    
      <?php
        $all_clients = $wpdb->get_results("
            SELECT * 
            FROM {$table_inquiries}");
      ?>
        <?php if(!empty( $all_clients)):?>
          <table id="customers">
            <tr>
              <th>№</th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_FIO"
                  data_field = "surname"
                  >Имя</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_TELEPHONE"
                  data_field = "tel"
                  >Контакты</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_EMAIL"
                  data_field = "email"
                  >Страна</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_COMPANY"
                  data_field = "company"
                  >Категория</a></th>
              <th><a 
                  href       = "javascript:;" 
                  class      = "order_clienst_by_SPHERE"
                  data_field = "sphere"
                  >Запрос</a></th>
                  <th></th>
            </tr>
          <?php
            $i = 0; 
            foreach($all_clients as $item):

              $i++; 
          ?>
            <tr class="selected_inquiries" data-id="<?=$item->id?>"> 
              <td><?=$i?></td>
              <td><?=$item->name?></td>
              <td><?=$item->contacts?></td>
              <td><?=$item->country?></td>
              <td><?=$item->category?></td>
              <td><?=$item->zapros?></td>
              <td style="color:red;font-size:18px;font-weight:bold" data-id="<?=$item->id?>" class="delete_inquiries">X</td>
            </tr>  
          <?php endforeach;?>
          </table>
        <?php endif;?>
  </div>
</section>
<?php
get_footer();