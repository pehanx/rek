<?php
/*
 * Template Name: Галерея
 *
 * Template Post Type: page
 *
 * The template for displaying Contacts page
 *
 * @package wptemplate
 *
 */
get_header();?>
<section class="typical" style="margin-top: 70px;">

    
<?php
$all_albums = array( 
    // array(
    //   Ссылка на главное фото,          например "https://russianexport.club/app/uploads/2019/12/191203-11-19-27.jpg",
    //   Описание альбома,                например "Реверсная Бизнес-миссия из Киргизской Республики и Республики Казахстан",
    //   Количество фотографий в альбоме, например 163,
    //   Шорткод для альбома,             например '[envira-gallery id="1311"]'
    //   Ссылка на новость,               например "https://russianexport.club/event/biznes-missiya-v-meksiku/"
    //   Дата галереи,                    например "25-26 ноября"
    // ),
    array(
      "https://russianexport.club/app/uploads/2019/12/191203-11-19-27.jpg", 
      "Реверсная Бизнес-миссия из Киргизской Республики и Республики Казахстан", 
      157,
      '[envira-gallery id="1311"]',
      "https://russianexport.club/1478-2/",
      "3-4 декабря"
    ),
    array(
      "https://russianexport.club/app/uploads/2019/12/2019-11-25-13.53.48-2.jpg", 
      "Реверсная Бизнес-миссия из Китая в г. Белгород" , 
      18,
      '[envira-gallery id="3175"]',
      "https://russianexport.club/belgorodskie-chipsy-i-myod-otpravyatsya-v-kitaj/",
      "25-26 ноября"
    ),
    array(
      "https://russianexport.club/app/uploads/2019/12/IMG_5760.jpg", 
      "Конференция «Преодолевая экспортные барьеры»" , 
      491,
      '[envira-gallery id="1641"]',
      "https://russianexport.club/preodolevaya-eksportnye-barery-v-magnitogorske-biznes-obsudil-problemy-zarubezhnoj-torgovli/",
      "13 сентября"
    ),
    array(
      "https://russianexport.club/app/uploads/2019/12/20190619-186-FORUM1-Timoshenko.jpg", 
      "Международный форум «Экспорт и инвестиции» в Челябинске" , 
      310,
      '[envira-gallery id="2261"]',
      "https://russianexport.club/natsionalnoe-kongress-byuro-nkb-prinyalo-uchastie-v-delovoj-programme-rossijskogo-investitsionnogo-foruma-2019-4/",
      "19-20 июня"
    )
); 

  $count_albums = count($all_albums);

if(isset($_GET['album'])):
  $album_id = $_GET['album'];?>
      <div class="contact__title">
        <?=$all_albums[$album_id][1]; ?>
      </div>
      <div class="typical__wrapp" style="position: relative; padding-top: 50px;">
        <p>Информация о прошедшем мероприятии по <a style="text-decoration: none;" href="<?=$all_albums[$album_id][4];?>">ссылке</a></p>
      <?php echo do_shortcode($all_albums[$album_id][3]);
else:?>
    <div class="contact__title">
        <?= get_the_title(); ?>
    </div>
    <div class="typical__wrapp" style="position: relative; padding-top: 50px;">
  <div style="display: flex;flex-wrap: wrap;
      -webkit-box-pack:justify;justify-content: center;">
    <?php for ($i=0; $i < $count_albums; $i++): ?>
      <div class="photos_album_thumb_wrap">
        <a href='?album=<?=$i?>' title="<?=$all_albums[$i][1]?>" style="cursor: pointer;">
          <div class="photos_album_thumb crisp_image" style="background-image: url('<?=$all_albums[$i][0];?>');">
            
           <div class="photos_album_title_wrap album_top">
              <div class="clear_fix">
                <div class="photos_album_title ge_photos_album">
                  <?=$all_albums[$i][5]?>
                </div>
              </div>
            </div>


            <div class="photos_album_title_wrap">
              <div class="clear_fix">
                <div class="photos_album_counter fl_r">
                  <?=$all_albums[$i][2]; ?>
                </div>
                <div class="photos_album_title ge_photos_album" title="<?=$all_albums[$i][1]?>">
                  <?=$all_albums[$i][1]?>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endfor; ?>
  </div>
<?php endif;?>
  </div>
</section>
<?php
get_footer();