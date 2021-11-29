<template>
  <div>
    <Nav />
    <b-container fluid class="header">
      <b-row>
        <b-col class="left">
          <div class="moto">
            <h1>Create your own</h1>
            <h1>
              <span>custom made</span> recipes!
            </h1>
          </div>

          <p class="text">
            Enjoy tailoring recipes to your own needs
            <br />and join us on a journey with an awesomely
            <br />free website Recipenow!
          </p>
          <div class="buttons">
            <router-link v-if="!$store.state.user.status" to="/login">
              <Button class="login-btn">Log in</Button>
            </router-link>
            <router-link to="/recipes">
              <Button class="start-btn">
                Start now
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
        <b-col class="right">
          <img :src="image" alt="picture" />
        </b-col>
      </b-row>
      <b-row class="cards">
        <b-col cols="4">
          <svg
            width="64"
            height="64"
            viewBox="0 0 64 64"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="32" cy="32" r="31.5" fill="white" stroke="#F9690E" />
            <path
              d="M39 26L28 37L23 32"
              stroke="#F9690E"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <div class="paragraph">
            <h2>
              <span>Easily</span>
            </h2>
            <p>track your ingredients and instructions</p>
          </div>
        </b-col>
        <b-col cols="4">
          <svg
            width="64"
            height="64"
            viewBox="0 0 64 64"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="32" cy="32" r="31.5" fill="white" stroke="#F9690E" />
            <path
              d="M39 26L28 37L23 32"
              stroke="#F9690E"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <div class="paragraph">
            <h2>
              <span>Quickly</span>
            </h2>
            <p>enter the necessary steps</p>
          </div>
        </b-col>
        <b-col cols="4">
          <svg
            width="64"
            height="64"
            viewBox="0 0 64 64"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle cx="32" cy="32" r="31.5" fill="white" stroke="#F9690E" />
            <path
              d="M39 26L28 37L23 32"
              stroke="#F9690E"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <div class="paragraph">
            <h2>
              <span>Completely</span>
            </h2>
            <p>adjust the recipe to your needs</p>
          </div>
        </b-col>
      </b-row>
    </b-container>
    <div class="box"></div>
    <Footer />
  </div>
</template>

<script>
import Nav from "../components/Nav";
import image from "../assets/hero-img.png";
import Footer from "../components/Footer";

export default {
  data() {
    return {
      image: image
    };
  },
  components: {
    Nav,
    Footer
  }
};
</script>

<style lang="scss" scoped>
.header {
  padding-left: 100px;
}

.row {
  display: flex;
  justify-content: center;
  align-items: center;
}
p {
  font-weight: 300;
  font-size: 20px;
}
.left {
  display: grid;
  justify-items: start;
  justify-content: space-evenly;
  text-align: start;
  h1 {
    font-size: 60px;
    font-weight: 600;
  }
  .moto {
    margin-bottom: 2rem;
  }
  .text {
    margin-bottom: 3rem;
  }
  span {
    color: #f9690e;
    display: inline;
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
.right {
  img {
    object-fit: cover;
  }
}
.cards {
  margin-top: 120px;
  justify-content: space-evenly;
  svg {
    margin-top: 70px;
  }
  .col-4 {
    display: grid;
    justify-items: center;
    justify-content: inherit;
    text-align: center;
    line-height: 1.2;
    height: 320px;
    max-width: 302px;
    border: 2px solid #e4e0e0;
    border-radius: 12px;
    transition: all 0.2s ease-in-out;
    &:hover {
      border: 2px solid #f9690e;
    }
    h2 {
      margin: 0;
    }
  }
  span {
    color: #f9690e;
  }
}
.box {
  height: 200px;
}
</style>
