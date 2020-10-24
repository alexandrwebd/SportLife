<?php include_once ROOT . '/views/layout/header-top.php'?>

<section class="section-title">
        <div class="container">
            <h3 class="section__gallery-title title wow fadeInLeft" data-wow-duration="1.5s">Наша галерея</h3>
        </div>
    </section>

    <template id="pagination-template">
        <div class="pagination">
            <div class="pagination__left" v-if="hasPrev()">
                <a id="pagination__left-link" href="#"  @click.prevent="changePage(prevPage)">Предыдущая</a>
            </div>
            <div class="pagination__mid"> {{ current }} <span>/</span> {{ totalPages }} </div>
            <div class="pagination__right">
                <a href="#" v-if="hasNext()" @click.prevent="changePage(nextPage)">Следующая</a>
            </div>
        </div>
    </template>

    <section class="gallery" id="app">
        <div class="gallery__inner gallery-popup">
            <div class="gallery__item" v-for="photo in photos">
                <a :href="photo.urls.small" class="gallery-link">
                    <img class="gallery__item-img  gallery__img-popup" :src="photo.urls.small" alt="gallery">
                     <span class="gallery__item--overlay"></span>
                </a>
            </div>
        </div>
        <div class="container">
            <pagination :current="currentPage" @page-changed="fetchPhotos" :total="totalPhotos" :per-page="perPage">
            </pagination>
        </div>
    </section>

    <?php include_once ROOT . '/views/layout/footer.php'?>