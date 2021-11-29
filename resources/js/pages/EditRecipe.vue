<template>
  <div>
    <Nav />
    <b-container>
      <b-row>
        <!--LEFT SIDE EDIT IMAGE-->
        <b-col class="edit-left" cols="5">
          <Upload
            ref="uploads"
            action="/edit-recipe/upload"
            :headers="{'x-csrf-token':token, 'X-Requested-With':'XMLHttpRequest'}"
            :on-success="handleSuccess"
            :on-error="handleError"
            :format="['jpg','jpeg','png']"
            :on-format-error="handleFormatError"
            :max-size="2048"
            :on-exceeded-size="handleMaxSize"
          >
            <Button v-if="!recipeData.image">Edit image</Button>
            <img class="recipe-img" :src="recipeData.image" alt />

            <!-- CHANGE BUTTON AND DELETE ON SERVER
            <Button class="change-button" v-if="recipeData.image">Change image</Button>
            -->
          </Upload>
        </b-col>

        <!--RIGHT SIDE ADD RECIPE-->
        <b-col class="edit-right" cols="7">
          <label for="recipeName" style="color:#f9690e">RECIPE NAME</label>
          <b-form-input v-model="recipeData.title" class="recipe" type="text"></b-form-input>
          <b-row class="people-minutes">
            <b-col cols="4">
              <label for="numOfPeople" style="color:#f9690e">PEOPLE</label>
              <b-form-input
                v-model="recipeData.numOfPeople"
                type="number"
                min="0"
                oninput="this.value = Math.abs(this.value)"
              ></b-form-input>
            </b-col>
            <b-col cols="4">
              <label for="cookTime" style="color:#f9690e">MINUTES</label>
              <b-form-input
                v-model="recipeData.cookTime"
                type="number"
                min="0"
                oninput="this.value = Math.abs(this.value)"
              ></b-form-input>
            </b-col>
          </b-row>
          <label for="difficulty" style="color:#f9690e">DIFFICULTY</label>
          <div class="difficulty-b">
            <b-form-group v-slot="{ariaDescribedby}">
              <b-form-radio-group
                class="btns"
                id="btn-radios"
                v-model="recipeData.difficultyName"
                :options="options"
                :aria-describedby="ariaDescribedby"
                button-variant="outline-primary"
                size="lg"
                name="radio-btn-outline"
                buttons
                plain
              ></b-form-radio-group>
            </b-form-group>
          </div>
          <div class="box1">
            <label for="ingredient" style="color:#f9690e">INGREDIENTS</label>
            <svg
              @click="addToIngredientCounter"
              width="36"
              height="36"
              viewBox="0 0 36 36"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <circle cx="18" cy="18" r="18" fill="#F9690E" fill-opacity="0.1" />
              <circle cx="18" cy="18" r="17.5" stroke="#F9690E" stroke-opacity="0.2" />
              <path
                d="M22.054 17.7C22.342 17.7 22.582 17.796 22.774 17.988C22.966 18.168 23.062 18.402 23.062 18.69C23.062 18.978 22.966 19.218 22.774 19.41C22.582 19.59 22.342 19.68 22.054 19.68H19.534V22.038C19.534 22.374 19.42 22.65 19.192 22.866C18.976 23.082 18.7 23.19 18.364 23.19C18.028 23.19 17.746 23.082 17.518 22.866C17.302 22.65 17.194 22.374 17.194 22.038V19.68H14.728C14.44 19.68 14.2 19.584 14.008 19.392C13.816 19.2 13.72 18.96 13.72 18.672C13.72 18.384 13.816 18.15 14.008 17.97C14.2 17.79 14.44 17.7 14.728 17.7H17.194V15.018C17.194 14.682 17.302 14.406 17.518 14.19C17.746 13.974 18.034 13.866 18.382 13.866C18.718 13.866 18.994 13.974 19.21 14.19C19.426 14.406 19.534 14.682 19.534 15.018V17.7H22.054Z"
                fill="#F9690E"
              />
            </svg>
          </div>

          <b-row
            v-for="(item, index) in recipeData.ingredients"
            v-bind:item="item"
            v-bind:index="index"
            v-bind:key="item.id"
            class="ingredient"
          >
            <b-col cols="4">
              <label for="grams">GRAMS</label>
              <b-form-input
                v-model="item.grams"
                type="number"
                min="0"
                oninput="this.value = Math.abs(this.value)"
              ></b-form-input>
            </b-col>
            <b-col cols="4">
              <label for="ingredientName">INGREDIENT</label>
              <b-form-input v-model="item.ingredient" type="text"></b-form-input>
            </b-col>
            <Button v-if="index>0" class="remove" @click="removeIngredient(index)">Remove</Button>
          </b-row>
          <div class="box2">
            <label for="ingredient" style="color:#f9690e">INSTRUCTIONS</label>
            <svg
              @click="addToInstructionCounter"
              width="36"
              height="36"
              viewBox="0 0 36 36"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <circle cx="18" cy="18" r="18" fill="#F9690E" fill-opacity="0.1" />
              <circle cx="18" cy="18" r="17.5" stroke="#F9690E" stroke-opacity="0.2" />
              <path
                d="M22.054 17.7C22.342 17.7 22.582 17.796 22.774 17.988C22.966 18.168 23.062 18.402 23.062 18.69C23.062 18.978 22.966 19.218 22.774 19.41C22.582 19.59 22.342 19.68 22.054 19.68H19.534V22.038C19.534 22.374 19.42 22.65 19.192 22.866C18.976 23.082 18.7 23.19 18.364 23.19C18.028 23.19 17.746 23.082 17.518 22.866C17.302 22.65 17.194 22.374 17.194 22.038V19.68H14.728C14.44 19.68 14.2 19.584 14.008 19.392C13.816 19.2 13.72 18.96 13.72 18.672C13.72 18.384 13.816 18.15 14.008 17.97C14.2 17.79 14.44 17.7 14.728 17.7H17.194V15.018C17.194 14.682 17.302 14.406 17.518 14.19C17.746 13.974 18.034 13.866 18.382 13.866C18.718 13.866 18.994 13.974 19.21 14.19C19.426 14.406 19.534 14.682 19.534 15.018V17.7H22.054Z"
                fill="#F9690E"
              />
            </svg>
          </div>

          <b-row
            v-for="(item,index) in recipeData.instructions"
            v-bind:item="item"
            v-bind:index="index"
            v-bind:key="item.id"
            class="instruction"
          >
            <div class="sup"></div>
            <Button v-if="index>0" class="remove" @click="removeInstruction(index)">Remove</Button>
            <label for="instructionName">TITLE</label>
            <b-form-input v-model="item.title " class="title" type="text"></b-form-input>

            <label class="recipe" for="instructionDesc">INSTRUCTION</label>
            <b-form-input v-model="item.instruction" class="instruction" type="text"></b-form-input>
          </b-row>

          <div class="buttons">
            <router-link to="/">
              <Button class="login-btn">Cancel</Button>
            </router-link>
            <router-link to="#">
              <Button
                @click="validateRecipe"
                class="start-btn"
                :loading="isEditing"
                :disabled="isEditing"
              >
                Save recipe
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
      <div class="space"></div>
    </b-container>
  </div>
</template>

<script>
import Nav from "../components/Nav";
export default {
  data() {
    return {
      id: this.$route.params.id,
      recipeData: {
        title: "",
        numOfPeople: "",
        cookTime: "",
        ingredients: [{ grams: "", ingredient: "" }],
        instructions: [{ title: "", instruction: "" }],
        image: "",
        user_id: this.$store.state.user.id,
        difficultyName: ""
      },
      difficultyList: [],
      isEditing: false,
      token: "",

      options: [
        { text: "Easy", value: "Easy" },
        { text: "Medium", value: "Medium" },
        { text: "Hard", value: "Hard" }
      ],
      ingredientCounter: "",
      instructionCounter: ""
    };
  },

  methods: {
    handleSuccess(res, file) {
      res = `/uploads/${res}`;
      // console.log(res);
      this.recipeData.image = res;
      this.$refs.uploads.clearFiles();
    },
    handleError(res, file) {
      console.log(file);
      this.$Notice.warning({
        title: `${file.message}`,
        desc: `${
          file.errors.file.length ? file.errors.file[0] : "Something went wrong"
        }`
      });
    },
    handleFormatError(file) {
      console.log(file);
      this.$Notice.warning({
        title: "File format is incorrect",
        desc:
          "File format of " +
          file.name +
          " is incorrect, please select jpg or png"
      });
    },
    handleMaxSize(file) {
      this.$Notice.warning({
        title: "Exceeding file size limit",
        desc: "File" + file.name + "is too big"
      });
    },
    addToIngredientCounter() {
      this.ingredientCounter++;
      let ingredientArray = [{ grams: "", ingredient: "" }];
      this.recipeData.ingredients.push(...ingredientArray);
    },
    addToInstructionCounter() {
      this.instructionCounter++;
      let instructionArray = [{ title: "", instruction: "" }];
      this.recipeData.instructions.push(...instructionArray);
    },
    removeIngredient(index) {
      this.recipeData.ingredients.splice(index, 1);
    },
    removeInstruction(index) {
      this.recipeData.instructions.splice(index, 1);
    },
    validateRecipe() {
      //FRONTEND VALIDATION
      var numString = this.recipeData.numOfPeople.toString();
      var cookString = this.recipeData.cookTime.toString();
      if (this.recipeData.title.trim() == "")
        return this.error("Title is required");
      else if (numString.trim() == "" || numString == 0)
        return this.error("Number of people must be entered");
      else if (cookString == "" || cookString == 0)
        return this.error("Cooking time must be entered");
      else if (this.recipeData.difficultyName.trim() == "")
        return this.error("Difficulty must be chosen");

      var validation = true;
      this.recipeData.ingredients.forEach(i => {
        if (i.grams.trim() == "") {
          validation = false;
          return this.error("You have to enter value in ingredients");
        } else if (i.ingredient.trim() == "") {
          validation = false;
          return this.error("You have to enter value in ingredients");
        }
      });
      this.recipeData.instructions.forEach(i => {
        if (i.title.trim() == "") {
          validation = false;
          return this.error("You have to enter value in instructions");
        } else if (i.instruction.trim() == "") {
          validation = false;
          return this.error("You have to enter value in instructions");
        }
      });
      if (validation === true) this.editRecipe();
    },
    async editRecipe() {
      this.isEditing = true;
      //Array to string
      this.recipeData.ingredients = JSON.stringify(this.recipeData.ingredients);
      this.recipeData.instructions = JSON.stringify(
        this.recipeData.instructions
      );

      const res = await this.callApi("post", "/edit-recipe", this.recipeData);
      if (res.status === 200) {
        console.log(res);
        //String to Array
        this.recipeData.ingredients = JSON.parse(res.data.ingredients);
        this.recipeData.instructions = JSON.parse(res.data.instructions);
        this.success("Recipe edited successfully, redirecting...");

        setTimeout(function() {
          window.location = "/recipes#/recipes";
        }, 1500);
      } else {
        console.log(res);
        this.swr();
      }
      this.isEditing = false;
    },
    async deleteImage() {
      var image = this.recipeData.imageName;
      this.recipeData.imageName = "";
      const res = await this.callApi("post", "recipe/delete-image", {
        imageName: image
      });
      if (res.status != 200) {
        this.recipeData.imageName = image;
        this.swr();
      }
    }
  },
  components: {
    Nav
  },
  async created() {
    this.token = window.Laravel.csrfToken;
    const res = await this.callApi("get", "/get-recipe/" + this.id);
    if (res.status === 200) {
      console.log(res.data[0]);
      this.$store.commit("setUserRecipe", res.data[0].user_id);
      this.recipeData = res.data[0];
      this.recipeData.ingredients = JSON.parse(res.data[0].ingredients);
      this.recipeData.instructions = JSON.parse(res.data[0].instructions);
    } else {
      this.swr();
    }
  }
};
</script>

<style lang="scss" >
.edit-left {
  background-color: #fff9f6;

  button {
    width: 204px;
    height: 64px;
    box-shadow: 0px 20px 50px 0px rgba(249, 105, 14, 0.3);
    background-color: #f9690e;
    box-shadow: rgba(249, 105, 14, 0.3) 0px 30px 100px -20px,
      rgba(249, 105, 14, 0.3) 0px 30px 60px -30px;
    transition: all 0.3s ease-in-out;
    color: white;
    font-size: 16px;
    font-weight: 700;
    border-radius: 8px;
    &:hover {
      color: white;
      background-color: rgba(249, 105, 14, 0.9);
      box-shadow: rgba(249, 105, 14, 0.7) 0px 20px 100px -20px,
        rgba(249, 105, 14, 0.7) 0px 20px 60px -30px;
      border-color: #f9690e;
    }
  }
  .recipe-img {
    object-fit: cover;
    max-width: 550px;
    max-height: 700px;
    cursor: pointer;
  }
  .ivu-upload {
    display: flex;
    flex-direction: column;
    min-height: 700px;
    justify-content: center;
    align-items: center;
  }

  .demo-upload-list-cover i {
    width: 30px;
    height: 30px;
    color: red;
    font-size: 20px;
    cursor: pointer;
    margin: 0 2px;
  }
}
.edit-right {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding-left: 80px;

  .form-control {
    max-width: 350px;
    outline: none;
    border-width: 0 0 1px;
    border-radius: 0;
    border-color: #3333334d;
    background-color: transparent;
    &:hover,
    &:focus {
      outline: none;
      box-shadow: none;
      border-width: 0 0 1px;
      transition: all 0.2s ease-in;
      border-color: #f9690e;
    }
  }
  .ingredient,
  .instruction {
    .remove {
      height: 30px;
      width: 100px;
      border-color: #3333334d;
      &:hover {
        color: #f9690e;
      }
      &:focus {
        color: white;
        background-color: #f9690e;
        border-color: #f9690e;
      }
    }
  }
  .instruction {
    .remove {
      margin-left: 150px;
      margin-top: 5px;
    }
  }

  .difficulty-b {
    label {
      border-color: #3333334d;
      &:hover {
        color: #f9690e;
      }
      &:focus {
        color: white;
        background-color: #f9690e;
        border-color: #f9690e;
      }
    }
  }
  .btns {
    background-color: #f9690e1a;
    label {
      color: #f9690e;
      &:hover {
        color: white;
        background-color: #f9690e;
      }
    }
    input {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }
    .active,
    .focus {
      background-color: #f9690e;
      color: white;
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

  .people-minutes,
  .ingredient {
    input {
      width: 100px;
    }
  }

  svg {
    cursor: pointer;
  }
  .sup {
    width: 100px;
    height: 5px;
    background: #f9690e;
  }
}

.space {
  height: 100px;
}
</style>