<template>
  <div class="home w-100">
    <div class="row w-90 d-flex justify-content-center">
      <div class="row d-flex justify-content-center" ref="scrollComponentIdioms">
        <div
          class="col-xxl-4 col-lg-6 col-md-6 col-xs-12"
          v-for="(idiom, index) in idioms"
          :key="index"
        >
        <!-- TODO: FIGURE OUT A WAY TO PROPERLY RESIZE FONTS ON PAGE RERENDER -->
          <CardIdiom
            :idiom="idiom"
            :index="index"
            :shouldResize="!allAreResized"
          />
        </div>
      </div>
      <div v-if="!$store.state.isFinishedIdioms" class="d-flex justify-content-center mb-5">
        <div class="spinner-border text--aquagreen" role="status">
          <span class="sr-only"></span>
        </div>
      </div>
      <div class="mb-5" v-else>
        <hr>
      </div>
      </div>
  </div>
</template>
<script>
import CardIdiom from "@/components/CardIdiom.vue";
import infScroll from "@/helpers/infScroll.js"
import {mapState} from 'vuex';

export default {
  name: "Idioms",
  computed: {
    ...mapState(['idioms'])
  },
  components: {
    CardIdiom,
  },

  data() {
    return {
      page: 0,
      defaultDispatchFunction: "fetchAllIdioms",
      objectType: 'idioms',
      defaultFinishedFlagInStore: "isFinishedIdioms",
      allAreResized: true
    };
  },

  created() {
    infScroll.verMais(this)
    console.log(this.$store.state)
  },

  mounted(){
    window.addEventListener('scroll', this.callableHandleScroll)
  },

  unmounted(){
    window.removeEventListener('scroll', this.callableHandleScroll)
  },

  methods: {
      // js apis are weird man
      callableHandleScroll(){
	  infScroll.handleScroll(this)
      }
    // verMais() {
      // console.log(this.$store.state.idioms.length);
      // this.showIndex = this.showIndex + 9;
      // if (this.showIndex > this.$store.state.idioms.length) {
        // this.hideButton = "d-none";
      // }
    // },
  },
  watch:{
    idioms(){
      this.allAreResized = !this.allAreResized
      console.log(this.allAreResized)
    }
  }
};
</script>
<style>
.text--aquagreen{
  color: #00d37f;
}
</style>
