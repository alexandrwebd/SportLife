var appId = 'bVkTp1q4M06N7Rp_4s3Or73-f3ee0iD0j50KP5famy4'

new Vue({
  el: '#app',
  data: {
    photos: [],
    totalPhotos: 0,
    perPage: 12,
    currentPage: 1
  },
  methods: {
    fetchPhotos: function(page) {
      var options = {
        params: {
          client_id: appId,
          page: page,
          per_page: this.perPage
        }
      }

      this.$http.get('https://api.unsplash.com/photos', options).then(function(response) {

        this.photos = response.data

        this.totalPhotos = parseInt(response.headers.get('x-total'))

        this.currentPage = page

      }, console.log)
    }
  },
  created: function() {
    this.fetchPhotos(this.currentPage)
  }
})