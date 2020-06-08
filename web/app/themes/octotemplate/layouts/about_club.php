<?php
/*
 * Template Name: О клубе
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
<style>
    /*.title-news_or_event-wrapp .img {
        width: 470px;
    }
    .title-news_or_event-wrapp .description {
        width: 390px;
    }*/
    .logos_apps{
        display: flex;
        flex-direction: row;
    }
    .img_logo{
        height:50px !important;
        margin: 5px;
    }
    .desc_why_me li{
        width: auto;
        text-align: left;
    }
    .content_reshenie{
        border: 4px solid #3465e2; 
        padding: 10px; 
        border-radius: 10px; 
        background-color: #fff;
        font-size: 16px !important; 
    }
    .aboutclub__img{
        width: 115px;
        height: 115px;
        margin-left: auto;
        margin-right: auto;
    }
    .aboutclub__items{
        display: flex;
        text-align: center;
    }
    .aboutclub__item{
        display: block;
        width: 20%;
        margin: 0 15px;
        padding: 10px;
    }
    .club_numbers .aboutclub__item{
        width: 33%;
    }
    .aboutclub__description{
        margin: 0;
    }
    .aboutclub__description .bold-text{
        width: auto;
    }
    .aboutclub__description .text{
        width: auto;
    }
    .desc_why_me{
        display: flex; 
        position: relative;
        justify-content: space-between;
    }
    .aboutclub__page img{
        margin-top: 0;
    }
@media only screen and (max-width: 767px) {
    .aboutclub__items{
        flex-direction: column;
    }
    .club_numbers .aboutclub__item{
        width: auto;
    }
    .aboutclub__item {
        width: auto;
        text-align: center;
        margin: 0 auto;
        margin-bottom: 20px;
    }
    .aboutclub__img{
        margin-left: auto;
        margin-right: auto;
    }
}
@media only screen and (max-width: 600px) {
    .desc_why_me {
        flex-direction: column;
    }
    .desc_why_me div{
        margin: 0 auto;
        width: 100% !important;
        text-align: center;
    }
    .desc_why_me div:nth-child(2) {
        margin-top: 30px
    }
    .logos_apps{
        display: flex;
        flex-direction: column;
    }
     .img_logo{
        height:auto !important;
        width: 150px !important
    }
}
</style>
<div class="aboutclub__page">
<section class="typical" style="margin-top: 70px;">
    <!-- <div class="contact__title">
        <?= get_the_title(); ?>
    </div> -->
    <div class="typical__wrapp " style="position: relative; padding-top: 50px;" >
        <div> 
            <p style="text-align: center;"><img src="https://russianexport.club/app/uploads/2019/11/russkij-polnotsvet1.png" style="height: auto;max-height: 130px"></p>
                <h3 style="font-weight: 500; text-align: center;">
                   <b>Российский экспортный клуб</b> – это площадка для взаимодействия экспортеров и экспертов по обмену опытом, мнениями и идеями по развитию экспорта и решению общих проблем.</h3>
                   <h3 style="font-weight: 500; text-align: center;">
                    Мы хотим сделать экспортный рынок понятным и доступным любому МСП, который хочет начать или развивать свой бизнес за рубежом.</h3>
<h3 style="font-weight: 500; text-align: center;">
                    Клуб создан, что бы настроить диалог участников клуба с государственными органами и структурами для решения системных проблем экспортеров.
                </h3>
        </div>
    <iframe style="width:auto;" src="https://drive.google.com/file/d/1iVECI27aeaelAe6A-DtvKhhnI7W-qMDP/preview" width="640" height="480"></iframe>
    </div>
</section>

<section class="typical" style="position: relative; z-index: 2">
    <div class="contact__bg" style="height: 100%"></div>
    <div class="typical__wrapp" style="padding-bottom: 30px;">
        <div style="margin-top: 70px;position: relative;">
            <h2 style="text-align: center; padding-top: 30px">Чем мы занимаемся</h2>
            <ul style="margin-top: 30px"><li>
                    Объединяем экспортные компании для обмена опытом и знаниями
                </li><li>
                    Знакомим экспортные компании с экспертами и партнерами
                </li><li>
                    Информируем о бизнес-миссиях, выставках и др. мероприятиях
                </li><li>
                    Помогаем с банками и частными инвесторами
                </li>
            </ul>
        </div>
    </div>
</section>


<section class="typical" style="position: relative">
    <div class="typical__wrapp" style="padding-bottom: 30px;">
        <div style="margin-top: 70px;position: relative;">
            <h2 style="text-align: center; padding-top: 30px">Цифры о клубе</h2>
            <div class="aboutclub__items club_numbers" style="padding-top: 30px;">
                    <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/07/90-uchastnikov-150x150.jpg">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">150 участников</p>
                            <p class="text">Клуб был создан 12 марта 2019г. С этого момента, число наших участников неизменно растет</p>
                        </div>
                    </div>
                    <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/07/6-ambassadorov-150x150.jpg">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">6 амбассадоров</p>
                            <p class="text">Активные представители интересов клуба в регионах России: Москва, Челябинская область, Свердловская область, Вологодская область, Башкортостан, Казань</p>
                        </div>
                    </div>
                    <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/07/3-meropriyatiya-150x150.jpg">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">7 мероприятий</p>
                            <p class="text">3 мероприятия в Челябинске, 1 в Великом Новгороде, 1 в Уфе, 1 в Магнитогорске, 1 в Барнауле</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>




<section class="typical" style="position: relative;z-index: 2">
    <div class="contact__bg" style="height: 100%"></div>
    <div class="typical__wrapp">
        <div>
            <h2 style="text-align: center; padding-top: 30px; position: relative;">Почему мы</h2>
            <div class="desc_why_me" style="padding-top: 30px;">
                <div style="width: 48%">
                    <p style="margin-bottom: 23px; text-align: center;"><img src="https://russianexport.club/app/uploads/2020/01/Group-2-2x-3.png" style="height: auto;max-height: 130px; margin-bottom: 0px"></p>
                    <p>Актуальная информация о мероприятиях для экспортеров в России и за рубежом</p>
                </div>
                 <div style="width: 48%">
                    <p style="margin-bottom: 23px; text-align: center;"><img src="https://russianexport.club/app/uploads/2020/01/Group-2-2x-2.png" style="height: auto;max-height: 130px; margin-bottom: 0px"></p>
                    <p>Организация вебинаров, лекций, семинаров с участием российских и зарубежных экспертов по иностранным рынкам</p>
                </div>
            </div>
            <div class="desc_why_me">
                <div style="width: 48%">
                    <p style="margin-bottom: 23px; text-align: center;"><img src="https://russianexport.club/app/uploads/2020/01/Group-2-2x-1.png" style="height: auto;max-height: 130px; margin-bottom: 0px"></p>
                    <p>Проведение конференций, форумов и неформальных встреч для экспортеров по обмену опытом, контактами и поиску выходов на внешние рынки</p>
                </div>
                 <div style="width: 48%">
                    <p style="margin-bottom: 23px; text-align: center;"><img src="https://russianexport.club/app/uploads/2020/01/Group-6-2x-1.png" style="height: auto;max-height: 130px; margin-bottom: 0px"></p>
                    <p>Бесплатное членство, простая регистрация на сайте и полезное мобильное приложение для всех участников</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="typical" style="position: relative">
    <div class="typical__wrapp" style="padding-bottom: 30px;">
        <div style="margin-top: 70px;position: relative;">
            <h2 style="text-align: center; padding-top: 30px">Участники клуба</h2>
            <div class="aboutclub__items" style="padding-top: 30px;">
                    <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/11/Users1.png">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">Экспортеры</p>
                            <p class="text">Участники клуба, которые хотят экспортировать свою продукцию</p>
                        </div>
                    </div>
                     <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/11/Dollar1.png">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">Инвесторы</p>
                            <p class="text"> Участники клуба, готовые инвестировать в интересную продукцию, проекты</p>
                        </div>
                    </div>
                     <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/11/Mikrofon1.png">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">Эксперты</p>
                            <p class="text">Участники клуба, которые делятся полезной и ценной информацией</p>
                        </div>
                    </div>
                     <div class="aboutclub__item">
                        <div class="aboutclub__img">
                            <img src="https://russianexport.club/app/uploads/2019/11/Hands1.png">
                        </div>
                        <div class="aboutclub__description">
                            <p class="bold-text" style="font-weight: bold">Партнеры</p>
                            <p class="text">Банки, организации и др. участники клуба готовые помочь с экспортом продукции</p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<section class="typical" style="margin-top: 70px;position: relative;">
        <div class="contact__bg" style="height: 100%"></div>
    <div class="typical__wrapp" style="position: relative;z-index:2; padding-bottom:20px">
        

            
        
      
            <!-- <div class="desc_why_me" style="padding-top: 30px; justify-content: space-between;"> -->
            
             <div class="desc_why_me" style="padding-top: 30px; justify-content: space-around;">
                <div style="width:40%;align-items: center;display: flex;">
                    <img style="height: auto;" src="https://russianexport.club/app/uploads/2019/11/default-noimage1.jpg" alt="">
                </div>
                <div style="width: 41%;align-items: center;display: flex;">
                    <h3 style="font-weight: 500; text-align: left;">
                        Российский экспортный клуб был<br> создан в марте 2019 года при Общероссийской общественной организации малого и среднего предпринимательства <br><b>«ОПОРА РОССИИ»</b>.
                    </h3>
                </div>
            </div>
   

                <h3 style="font-weight: 500; text-align: center;">
                    <b>Основная цель деятельности «ОПОРЫ РОССИИ»</b> – содействие консолидации предпринимателей и иных граждан для участия в формировании благоприятных политических, экономических, правовых и иных условий развития предпринимательской деятельности в Российской Федерации, обеспечивающих эффективное развитие экономики.
                </h3>
    </div>
</section>
<section class="typical" style="margin-top: 20px;">
    <div class="typical__wrapp" style="position: relative;" >
            <div class="desc_why_me" style="padding-top: 30px; justify-content: space-between;">
                <div style="width: 45%;">
                    <h3 style="font-weight: 500; text-align: center;">
                    «ОПОРА РОССИИ» сегодня:  
                    </h3>
                     <ul style="margin-top: 30px">
                <!-- <li style="margin-left: auto;margin-right: auto;"> -->
                <li>
                    Крупнейшая бизнес-сеть, представленная во всех российских регионах
                </li>
                <li>
                    Сообщество единомышленников
                </li>
                <li>
                    Экспертная сила, решающая самые сложные задачи в сфере предпринимательства
                </li>
                <li>
                    Бренд «ОПОРА РОССИИ» объединяет более 400 000 предпринимателей
                </li>
                <li>
                    100+ отраслевых союзов, ассоциаций, гильдий, иных членов в составе Ассоциации «Некоммерческое Партнерство Объединение предпринимательских организаций «ОПОРА» (структура в составе «ОПОРЫ РОССИИ»)
                </li>
                <li>
                    1000+ федеральных и региональных мероприятий в год
                </li>
            </ul>
                </div>
                <div style="width: 45%;">
                    <h3 style="font-weight: 500; text-align: center;">
                    Задачи «ОПОРЫ РОССИИ»:
                    </h3>
                    <ul style="margin-top: 30px">
                <li>
                    Защита прав и интересов предпринимателей
                    15 000+ обращений за 16 лет в Бюро по защите прав предпринимателей и инвесторов при «ОПОРЕ РОССИИ».
                </li>
                <li>
                    Исследования и аналитика в сфере предпринимательства
                    2000+ обращений в год в Центр экспертизы и аналитики проблем предпринимательства и подготовка авторитетных исследований
                </li>
                <li>
                    Международная кооперация
                    Более 30 представителей «ОПОРЫ РОССИИ» работает за рубежом.
                </li><li>
                    Популяризация предпринимательства
                </li><li>
                    Проведение форумов, нетворкингов, выставок, b2b-сессий, бизнес-миссий, мастер-классов, вебинаров, семинаров и иных форматов.
                </li>
            </ul>
                </div>
            </div>
    </div>
</section>

<section class="typical" id="mobile_apps" style="position: relative;">
    <div class="contact__bg" style="height: 100%"></div>
    <div class="typical__wrapp" style="padding-bottom: 30px;">
        <div style="margin-top: 70px;position: relative;">
            <h2 style="text-align: center; padding-top: 30px">Мобильное приложение <br>РОССИЙСКИЙ ЭКСПОРТНЫЙ КЛУБ</h2>
            <h3 style="font-weight: 500; text-align: center;">
                Для всех членов экспортного клуба доступно мобильное приложение Российский экспортный клуб
            </h3>
            <ul style="margin-top: 30px"><li>
                    Будьте в курсе мероприятий и событий в общественной жизни Российского Экспортного Клуба в режиме реального времени
                </li><li>
                    Общайтесь, с экспортерами со всей России, и не только, меняйся опытом и знаниями
                </li><li>
                    Получайте полный доступ к полезным материалам и вебинарам
                </li><li>
                    Используйте возможности мобильного приложения Российский Экспортный Клуб для бизнеса и повседневной жизни
                </li>
            </ul>
            <p>Доступно в GooglePlay и AppStore</p>
            <div class="logos_apps" style="margin-bottom:10px">
                <a style="margin-bottom: 0" target="_blank" href="https://apps.apple.com/ru/app/%D1%80%D0%BE%D1%81%D1%81%D0%B8%D0%B9%D1%81%D0%BA%D0%B8%D0%B9-%D1%8D%D0%BA%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%BD%D1%8B%D0%B9-%D0%BA%D0%BB%D1%83%D0%B1/id1490232250">
                   <img class="img_logo" src="https://russianexport.club/app/uploads/2020/01/Download_on_the_App_Store_Badge_RU_RGB_blk_100317-1.png" alt=""> 
                </a>
                <a style="margin-bottom: 0"  target="_blank" href="https://play.google.com/store/apps/details?id=com.g2rcompany">
                   <img class="img_logo" src="https://russianexport.club/app/uploads/2020/01/google-play-badge-e1580302537769.png" alt=""> 
                </a>
            </div>
            *Для входа в приложение используйте Ваш электронный адрес и пароль, которые вы используете на сайте Российского Экспортного Клуба
        </div>
    </div>
</section>

<section class="inclub" style="margin-bottom: 0;">
    <div class="inclub__wrapp">
        <div class="inclub__text">
            Хотите сделать свой бизнес эффективнее?                                
        </div>
        <a href="javascript:void(0);" class="inclub__button to_auth_page">Вступить в клуб</a>
    </div>
</section>

</div>

<?php
get_footer();