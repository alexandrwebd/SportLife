 <?php include_once ROOT . '/views/layout/header.php' ?>

 <section class="about">

   <div class="online-form online-form__modal wow fadeInUp" data-wow-duration="1.5s" id="online-form__modal">
     <div class="online-form__bg">
       <img src="public/images/online-form1.jpg" alt="bg man">
     </div>
     <div class="online-form__content">
       <h3 class="online-form__title title"><span>Получи бесплатную тренировку</span> <br>
         Online Бронирование</h3>
       <p class="text-danger" id="error_messages"></p>
       <form method="POST" class="online-form__form" id="mail-form">
         <div class="online-form__date-wrapper">
           <input type="date" class="online-form__item form__item-date" id="form-date" value="2020-04-19">
           <label class="online-form__label form-date__label" for="form-date"></label>
         </div>
         <input type="text" class="online-form__item" id="form-name" placeholder="Имя">
         <input type="tel" class="online-form__item" id="form-phone" placeholder="Телефон" required>
         <input type="email" class="online-form__item" id="form-email" placeholder="E-mail" required>
       </form>
       <button class="online-form__btn btn" id="sendMail">Заказать</button>
     </div>
   </div>

   <div class="about__bg wow fadeInRight" data-wow-offset="500" data-wow-duration="1.5s">
     <img src="public/images/about2.png" alt="about" class="about__bg-img">
   </div>
   <div class="container">
     <div class="about__text">
       <h1 class="about__text-title title"> <?= $maim_pages['main_about_title']; ?> </h1>
       <p class="about__text-subtitle">
         <?= $maim_pages['main_about_subtitle']; ?>
       </p>
       <p class="about__text-description">
         <?= $maim_pages['main_about_description']; ?>
       </p>
     </div>

     <div class="about__advantages-inner wow fadeInLeftBig" data-wow-duration="1.5s">

       <?php $i = 1; ?>
       <?php foreach ($advantages as $advantage) : ?>
         <div class="about__advantages-item">
           <div class="advantages-item__text advantages-item__text-<?= $i; ?>">
             <?= $advantage['advantages']; ?>
           </div>
         </div>
         <?php $i++; ?>
       <?php endforeach; ?>

     </div>
     <a href="/about" class="about__text-btn btn">Посетить нас</a>
   </div>
 </section>

 <section class="services">
   <div class="container">
     <h3 class="services__title title"> <?= $maim_pages['services_title']; ?> </h3>
     <div class="services__subtitle">
       <?= $maim_pages['services_description']; ?>
     </div>
     <div class="services-slider">

       <?php foreach ($services as $service) : ?>
         <div class="services-slider__item services-slider__item-1 wow fadeInUpBig" data-wow-duration="<?= $service['duration']; ?>s">
           <div class="services__item-img">
             <img src="public/images/<?= $service['image']; ?>" alt="<?= $service['image_alt']; ?>" class="services__img">
           </div>
           <div class="services__text">
             <div class="services__text-wrapper">
               <div class="services-slider__title"><?= $service['name']; ?></div>
               <div class="services-slider__text"><?= $service['description']; ?></div>
             </div>
             <a href="/services-detail/<?= $service['id']; ?>" class="services-slider__btn btn">Узнать больше</a>
           </div>
         </div>
       <?php endforeach; ?>

     </div>
   </div>
 </section>

 <section class="trainer" style="background-image: url(public/images/<?= $maim_pages['trainer_images']; ?>);">
   <div class="trainer-blackout"></div>
   <div class="container">
     <div class="trainer__wrapper">
       <h2 class="trainer__title"><?= $maim_pages['trainer_title']; ?></h2>
       <a href="/team" class="trainer__btn btn wow tada" data-wow-offset="300">Наша команда</a>
     </div>
   </div>
 </section>

 <section class="schedule">
   <div class="schedule__img wow bounceInRight" data-wow-duration="1.5s" data-wow-offset="400">
     <img src="public/images/schedule.jpg" alt="расписание тренеровок">
   </div>
   <div class="container">
     <h3 class="schedule__title title"><?= $maim_pages['schedule_title']; ?></h3>
     <div class="schedule__inner" id="training-time">
       <div class="schedule__inner-day">
         <div class="schedule__day-item" v-for="(d, key) of days">
           <a href="#" class="schedule-day" :class="{'schedule__btn--active': day == days[key]}" @click.prevent="getTraining(key)"> {{days[key]}} </a>
           <span class="schedule-day__data" v-if="day == days[key]">{{data}}</span>
         </div>
       </div>
       <div class="schedule__inner-item">
         <div :class="[isActive ? 'schedule__item-sunday--active' : 'schedule__item']" v-for="training in trainings">
           <a href="#" class="schedule__item-time"> {{training.time}} </a>
           <span class="schedule__icon"></span>
           <div class="schedule__item-title"> {{training.name}} </div>
           <div class="schedule__item-trener"> {{training.trener}} </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 <section class="reviews">
   <div class="container">
     <h3 class="reviews__title title"><?= $maim_pages['reviews_title']; ?></h3>
     <div class="reviews__slider-inner">



       <?php foreach ($reviews as $review) : ?>
         <div class="reviews__slider-item">
           <div class="reviews__slider-img">

             <?php if ($review['profile_img'] != NULL) : ?>
               <img src="/public/images/profile/<?= $review['profile_img'] ?>" alt="фото профиля" class="circle float-left profile-photo" width="50" height="auto">
             <?php else : ?>
               <img src="public/images/profile/reviews.jpg" alt="фото профиля" class="reviews-img">
             <?php endif; ?>

           </div>
           <div class="reviews__slider-text">
             <div class="reviews__text-title"><?= $review['name']; ?><span><?= $review['date_add']; ?></span></div>
             <p class="reviews-text wow fadeInUp" data-wow-offset="200">
               <?= $review['text']; ?>
             </p>
           </div>
         </div>
       <?php endforeach; ?>

     </div>
   </div>
 </section>

 <section class="communication">
   <div class="communication-blackout"></div>
   <div class="communication__wrapper-bg">
     <div class="communication__form-bg communication-img" style="background-image: url(public/images/<?= $maim_pages['baner_form_images']; ?>);"></div>
     <div class="communication__phone-bg communication-img" style="background-image: url(public/images/<?= $maim_pages['contacts_form_images']; ?>);"></div>
   </div>
   <div class="container">
     <div class="communication__text-inner">
       <div class="communication__text-item">
         <div class="communication__text-subtitle subtitle-online"><?= $maim_pages['baner_form_subtitle']; ?></div>
         <div class="communication__text-title title"><?= $maim_pages['baner_form_title']; ?></div>
         <a href="#online-form__modal" class="communication__text-btn communication__btn-left btn wow fadeIn" data-wow-offset="300">Заполнить</a>
       </div>
       <div class="communication__text-item communication__item-phone">
         <div class="communication__text-subtitle subtitle-phone"><?= $maim_pages['contacts_form_subtitle']; ?></div>
         <div class="communication__text-title title"><?= $maim_pages['contacts_form_phone']; ?></div>
         <a href="/contacts" class="communication__text-btn communication__btn-right btn wow fadeIn" data-wow-offset="300">Связаться</a>
       </div>
     </div>
   </div>
 </section>

 <?php include_once ROOT . '/views/layout/footer.php' ?>