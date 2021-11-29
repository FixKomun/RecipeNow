<template>
  <div>
    <Nav />

    <!-- COPY OF BANNER WITH RECIPE DATA -->
    <div class="banner">
      <div class="recently">
        <h1 class="top-title">
          How to:
          <span>{{ recipe.title }}</span>
        </h1>
        <div class="image">
          <img :src="`${recipe.image}`" alt />
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
      <div class="orange-box"></div>
    </div>

    <b-container class="main">
      <b-row>
        <!-- LEFT SIDE MAIN CONTENT-->
        <b-col cols="6" class="ingredients">
          <div class="title-ingredient">
            <h2>Prepare now</h2>
            <div class="line-row">
              <hr class="line" />
              <span class="number">ingredients</span>
              <hr class="line" />
            </div>
          </div>
          <b-row class="ingredient-list">
            <b-col v-for="(ingredient,i) in recipe.ingredients" :key="i" cols="6">
              <div class="grams">
                <h2>
                  {{ingredient.grams}}
                  <span>grams</span>
                </h2>
              </div>
              <h2 class="ingredient">{{ingredient.ingredient}}</h2>
            </b-col>
          </b-row>
          <div class="tip">
            <h2>
              Tip of
              <span>the day</span>
            </h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit ab obcaecati repellat commodi. Minima, consequuntur?</p>
            <div class="tip-box">
              <div class="svg">
                <svg
                  width="33"
                  height="22"
                  viewBox="0 0 33 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M7.72503 21.2754C11.8107 21.2754 15.0366 17.9628 15.0366 13.8772C15.0366 9.79157 11.6811 6.479 7.59549 6.479C7.55462 6.479 7.49297 6.48454 7.4521 6.48523C9.06751 5.19886 11.0965 4.42371 13.3173 4.42371C14.3391 4.42371 15.1613 3.59522 15.1613 2.57416C15.1613 1.5531 14.5039 0.724611 13.4822 0.724611C6.23015 0.725304 0.500005 6.62516 0.500005 13.8772C0.500005 13.8786 0.500005 13.88 0.500005 13.8821C0.500005 17.9656 3.64078 21.2754 7.72503 21.2754Z"
                    fill="#F9690E"
                  />
                  <path
                    d="M25.0533 21.2754C29.1389 21.2754 32.3705 17.9628 32.3705 13.8772C32.3705 9.79157 29.0177 6.479 24.9314 6.479C24.8905 6.479 24.8303 6.48454 24.7894 6.48523C26.4048 5.19886 28.4345 4.42371 30.6553 4.42371C31.6771 4.42371 32.5 3.59522 32.5 2.57416C32.5 1.5531 31.8322 0.724611 30.8105 0.724611C23.5584 0.725304 17.8179 6.62516 17.8179 13.8772C17.8179 13.8786 17.8179 13.88 17.8179 13.8821C17.8179 17.9656 20.9691 21.2754 25.0533 21.2754Z"
                    fill="#F9690E"
                  />
                </svg>
              </div>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
              <img :src="avatar" alt />
              <span>Marko Marić</span>
            </div>
          </div>
        </b-col>
        <!-- RIGHT SIDE MAIN CONTENT-->
        <b-col cols="6" class="instructions">
          <div class="title-instruction">
            <h2>Start cooking</h2>
            <div class="line-row">
              <hr class="line" />
              <span class="number">instructions</span>
              <hr class="line" />
            </div>
          </div>
          <b-row class="instruction-list" v-for="(instruction,i) in recipe.instructions" :key="i">
            <b-col>
              <div class="instruction-number">
                <h2 class="bold">{{i+1}}</h2>
              </div>
              <div class="instruction-info">
                <h2 class="bold">{{instruction.title}}</h2>
                <p>{{instruction.instruction}}</p>
              </div>
            </b-col>
          </b-row>
          <div class="buttons">
            <router-link
              v-if="$store.state.user.id==recipe.user_id"
              v-bind:to="'/edit-recipe/' + this.id"
            >
              <Button class="login-btn">Edit Recipe</Button>
            </router-link>
            <router-link v-if="$store.state.user.status" to="/new-recipe">
              <Button class="start-btn" :loading="isCreating" :disabled="isCreating">
                New recipe
                <svg
                  width="28"
                  height="28"
                  viewBox="0 0 28 28"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M14 27C21.1797 27 27 21.1797 27 14C27 6.8203 21.1797 1 14 1C6.8203 1 1 6.8203 1 14C1 21.1797 6.8203 27 14 27Z"
                    stroke="white"
                    stroke-opacity="0.2"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M15 18L19 14L15 10"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                  <path
                    d="M9 14H17"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
              </Button>
            </router-link>
          </div>
        </b-col>
      </b-row>
    </b-container>
    <Footer />
  </div>
</template>

<script>
import Nav from "../components/Nav";
import Banner from "../components/Banner";
import Footer from "../components/Footer";
import avatar from "../assets/Images/Avatar.png";

export default {
  data() {
    return {
      id: this.$route.params.id,
      recipe: [],
      avatar: avatar,
      isCreating: false,
      isEditing: false
    };
  },

  components: {
    Nav,
    Banner,
    Footer
  },

  async created() {
    const res = await this.callApi("get", "/get-recipe/" + this.id);

    if (res.status === 200) {
      this.$store.commit("setUserRecipe", res.data[0].user_id);
      this.recipe = res.data[0];
      this.recipe.ingredients = JSON.parse(res.data[0].ingredients);
      this.recipe.instructions = JSON.parse(res.data[0].instructions);
    } else console.log(res);
  }
};
</script>

<style lang="scss" scoped>
span {
  color: #f9690e;
}
.main {
  max-width: 1920px;
  margin-top: -270px;
  .row {
    display: flex;
    margin-bottom: 50px;
    .title-ingredient,
    .title-instruction {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-bottom: 45px;
      h2 {
        font-size: 24px;
        font-weight: normal;
      }
    }
    .ingredients {
      padding: 0;

      .ingredient-list {
        margin-left: 70px;
        width: 80%;
        .col-6 {
          display: flex;
          align-items: center;

          margin-bottom: 40px;

          .grams {
            height: 50px;
            width: 140px;
            border: 1px solid #b1d8bc;
            border-radius: 4px;
            margin-right: 15px;
            h2 {
              font-size: 24px;
              font-weight: 700;
              margin-top: 6px;
              text-align: center;
              span {
                font-size: 20px;
                font-weight: 300;
                color: #333333e0;
              }
            }
          }
          h2 {
            font-size: 24px;
            font-weight: normal;
            text-align: center;
            margin: 0;
          }
        }
      }

      .tip {
        border: 1px solid rgba(177, 216, 188, 0.6);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-self: center;
        align-items: center;
        max-width: 550px;
        padding: 30px 0 30px 0;
        margin-left: 60px;
        p {
          text-align: center;
          margin-top: 1rem;
        }
      }
      .tip-box {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 10px;

        span {
          margin-left: 12px;
          font-size: 24px;
          font-weight: 600;
          white-space: nowrap;
        }
        .svg {
          height: 32px;
          width: 32px;
          margin-left: 20px;
        }
      }
    }
    .instructions {
      .instruction-list {
        .col {
          display: flex;
          .instruction-number {
            height: 64px;
            width: 64px;
            border: 1px solid #b1d8bc;
            border-radius: 64px;
            margin-right: 20px;
            h2 {
              font-size: 24px;
              font-weight: 700;
              text-align: center;
              margin: 15px 0 0 0;
            }
          }
          .instruction-info {
            display: flex;
            flex-direction: column;
            h2 {
              font-size: 28px;
              font-weight: 700;
            }
            p {
              font-size: 20px;
              font-weight: 300;
            }
          }
        }
      }
      .buttons {
        button {
          font-size: 16px;
          font-weight: 600;
          border-radius: 8px;
        }
        .login-btn {
          width: 168px;
          height: 64px;
          color: #333333e0;
          border: 1px solid #f9690e;
          margin-right: 16px;
          transition: all 0.3s ease-in-out;

          &:hover {
            border: 1px solid rgba(249, 105, 14, 0.4);
          }
        }
        .start-btn {
          width: 232px;
          height: 74px;
          box-shadow: 0px 20px 50px 0px rgba(249, 105, 14, 0.3);
          background-color: #f9690e;
          box-shadow: rgba(249, 105, 14, 0.3) 0px 30px 100px -20px,
            rgba(249, 105, 14, 0.3) 0px 30px 60px -30px;
          transition: all 0.3s ease-in-out;
          color: white;
          &:hover {
            background-color: rgba(249, 105, 14, 0.9);
            box-shadow: rgba(249, 105, 14, 0.7) 0px 20px 100px -20px,
              rgba(249, 105, 14, 0.7) 0px 20px 60px -30px;
            border-color: #f9690e;
          }
        }
      }
    }

    .line-row {
      max-width: 350px;
      display: flex;

      text-align: center;
      hr {
        width: 70px;
        border: 0;
        height: 0;
        opacity: 1;
        // margin: 0 10px 0 10px;
        border: 2px solid #f9690e;
        border-radius: 3px;
      }
      span {
        font-size: 40px;
        font-weight: 600;
        margin: 0 10px 20px 10px;
        line-height: 0.85;
        max-height: 68px;
        white-space: break-spaces;
      }
    }
  }
}
</style>