<template>
    <div :key="renderKey">
        <!--NAVIGATION-->
        <Nav />
        <b-container class="main">
            <b-row>
                <div v-if="recipes.length == 0">
                    <h2>No recipes</h2>
                </div>
                <b-col v-for="(recipe, i) in recipes" :key="i" cols="3">
                    <h3>Recipe for</h3>
                    <div class="line-row">
                        <hr class="line" />
                        <span class="number">{{ recipe.title }}</span>
                        <hr class="line" />
                    </div>
                    <img :src="`${recipe.image}`" alt />
                    <div class="info-box">
                        <div class="min">
                            <span class="number">{{ recipe.cookTime }}</span>
                            <h2>min</h2>
                        </div>

                        <div class="person">
                            <span class="number">{{ recipe.numOfPeople }}</span>
                            <h2>person</h2>
                        </div>
                        <div class="difficulty">
                            <span>{{ recipe.difficultyName }}</span>
                        </div>
                    </div>
                    <router-link v-bind:to="'/recipes/' + recipe.id">
                        <Button :loading="isLoading" :disabled="isLoading">
                            Cook now
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
                </b-col>
            </b-row>
            <hr />
        </b-container>

        <!--FOOTER-->
        <Footer />
    </div>
</template>

<script>
import Nav from "../components/Nav";
import Footer from "../components/Footer";

export default {
    data() {
        return {
            recipes: [],
            isLoading: false,
            id: "",
            renderKey: 0,
        };
    },
    components: {
        Nav,
        Footer,
    },
    methods: {},
    async created() {
        this.id = this.$store.state.user.id;
        console.log(this.id);
        const res = await this.callApi("get", "get-user-recipes/" + this.id);
        console.log(res.data);
        if (res.status === 200) {
            this.recipes = res.data;
        } else {
            console.log(res);
            this.swr();
        }
    },
};
</script>

<style lang="scss" scoped>
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

.main {
    max-width: 1920px;

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-3 {
        max-width: 350px;
        height: 570px;
        padding: 0;
        margin: 0 60px 80px 60px;
        display: flex;
        flex-direction: column;
        align-items: center;

        h3 {
            font-weight: 400;
            font-size: 24px;
            margin: 0;
            margin-bottom: 10px;
        }
        img {
            width: 350px;
            min-height: 300px;
            object-fit: cover;
            margin: 20px 0px 20px 0px;
            border-radius: 8px;
        }
        .line-row {
            max-width: 350px;
            min-height: 90px;
            display: flex;
            align-items: center;
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
                margin: 0 10px 20px 10px;
                line-height: 0.85;
                max-height: 68px;
                white-space: break-spaces;
            }
        }

        .info-box {
            width: 350px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        button {
            width: 350px;
            height: 50px;
            margin-top: 20px;
            box-shadow: 0px 20px 50px 0px rgba(249, 105, 14, 0.3);
            background-color: #f9690e;
            box-shadow: rgba(249, 105, 14, 0.3) 0px 30px 100px -20px,
                rgba(249, 105, 14, 0.3) 0px 30px 60px -30px;
            transition: all 0.3s ease-in-out;
            color: white;
            font-size: 16px;
            font-weight: 700;
            &:hover {
                background-color: rgba(249, 105, 14, 0.9);
                box-shadow: rgba(249, 105, 14, 0.7) 0px 20px 100px -20px,
                    rgba(249, 105, 14, 0.7) 0px 20px 60px -30px;
                border-color: #f9690e;
            }
        }
    }
    .load {
        display: flex;
        align-self: center;
        justify-content: center;
        margin: 80px 0 80px 0;

        h2 {
            font-size: 24px;
            font-weight: 400;
            color: #333333e0;
            margin: 0;
            margin-right: 1rem;
        }
        .load-more {
            display: flex;
            cursor: pointer;

            svg {
                transition: all 0.3s ease;
                &:hover {
                    margin: 10px;
                    margin-top: 0px;
                    width: 35px;
                    height: 35px;
                }
            }
        }
    }
}
</style>
