<template>
    <div>
        <gmap-map
            :center="center"
            :zoom="12"
            :options="mapOptions"
            style="width:100%;  height: 100vh;"
        >
        <gmap-marker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :icon="m.icon"
            @mouseover="toggleInfoWindow(m, index)"
            @click="detail(m.id)"
        ></gmap-marker>
        <gmap-info-window
            :options="infoOptions"
            :position="infoWindowPos"
            :opened="infoWinOpen"
            @closeclick="infoWinOpen=false"

        >
            <div v-html="infoContent"></div>
        </gmap-info-window>
        </gmap-map>
    </div>
</template>

<script>
    export default {
        name: "GoogleMapComponent",
        data() {
            return {
                // default to Montreal to keep it simple
                // change this to whatever makes sense
                center: { lat: 45.508, lng: -73.587 },
                markers: [],
                places: [],
                currentPlace: null,
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                },
                infoWindowPos: {
                    lat: 0,
                    lng: 0
                },
                infoContent: '',
                infoWinOpen: false,
                markerIcon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
                mapOptions: {
                    styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ]
                }
            };
        },

        mounted() {
            this.geolocate();
            axios.get('api/map').then(response => {
                if(response.status === 200){
                    //this.markers = response.data;
                    let marker = {};
                    response.data.forEach(item =>{
                        marker = {
                            lat: parseFloat(item.map_lat),
                            lng: parseFloat(item.map_lng),
                        };
                        this.markers.push({
                            id: item.UpId,
                            position: marker,
                            name: item.title,
                            price: item.price,
                            img:item.images[0],
                            });
                    });

                }
            }).catch(err => {

            }).finally(() => {

            });
        },

        methods: {
            toggleInfoWindow: function (marker, idx) {
                this.infoWindowPos = marker.position;
                this.infoContent = this.getInfoWindowContent(marker);

                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            },
            getInfoWindowContent(marker){
                //this.detail();
                return (
                    `<div class="" style="cursor: pointer;" >
                        <img src="${marker.img.image}" style="width: 110px; height: 60px;" alt="">
                      <div>
                        <div>
                          <div class="m-2"><span style="font-weight: bold;">Title: </span>
                            ${marker.name}
                          </div>
                        </div>
                        <div class="m-2"><span style="font-weight: bold;">Price:  </span>
                          ${marker.price+"$"}
                          <br>
                        </div>
                        <button type="button" @click="detail()"> Visit Page</button>
                      </div>
                    </div>`);

            },
            detail(id){
                window.localStorage.setItem('setId',id);
                this.$router.push({name:'product.detail'});
            },
            geolocate: function() {
                navigator.geolocation.getCurrentPosition(position => {
                    this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                });
            }
        }
    }
</script>

<style scoped>

</style>
