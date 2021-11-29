<template>
  <div>
    <div class="banner">
      <div v-for="(recipe,index) in recipes" :key="index" class="recently-loop">
        <div v-if="index==recipes.length-1" class="recently">
          <h1 class="top-title">
            Added
            <span>recently</span>
          </h1>
          <h1 class="recipe-title">{{ recipe.title }}</h1>
          <div class="image">
            <router-link v-bind:to="'/recipes/'+recipe.id">
              <img :src="`${recipe.image}`" alt />
            </router-link>
          </div>
          <div class="info-box">
            <div class="min">
              <span class="number">{{recipe.cookTime}}</span>
              <h2>min</h2>
            </div>

            <div class="person">
              <span class="number">{{recipe.numOfPeople}}</span>
              <h2>person</h2>
            </div>
            <div class="difficulty">
              <span>{{recipe.difficultyName}}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="orange-box"></div>
    </div>
  </div>
</template>

<script>
import TopImage from "../assets/images/cover.jpg";
export default {
  data() {
    return {
      topImage: TopImage,
      recipes: []
    };
  },
  async created() {
    const res = await this.callApi("get", "recipe/get-recipes");
    if (res.status === 200) {
      this.recipes = res.data;
    } else {
      this.swr();
    }
  }
};
</script>

<style lang="scss" >
.banner {
  span {
    color: #f9690e;
  }
  .number {
    font-size: 40px;
    font-weight: 700;
  }
  .difficulty,
  h2 {
    font-size: 24px;
    font-weight: 400;
  }
  .min,
  .person,
  .difficulty {
    display: flex;
    h2 {
      align-self: center;
      margin: 2px 0 0 8px;
    }
  }
  .orange-box {
    position: relative;
    top: -350px;
    background-color: #f9790e;
    height: 455px;
  }

  .recently {
    display: flex;
    flex-direction: column;
    align-items: center;

    .top-title {
      margin-bottom: 60px;
    }
    .recipe-title {
      font-size: 40px;
      text-align: center;
      margin-bottom: 10px;
    }

    .image {
      display: flex;
      z-index: 2;
      img {
        height: 486px;
        width: 1320px;
        border-radius: 1rem;
        object-fit: cover;
      }
    }
    .info-box {
      display: flex;
      position: relative;
      align-items: center;
      justify-content: space-evenly;

      top: -50px;
      width: 538px;
      height: 100px;
      border-radius: 1rem;
      background-color: white;
      z-index: 3;
    }
  }
}
</style>