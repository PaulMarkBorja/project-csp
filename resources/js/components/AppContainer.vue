<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app expand-on-hover>
            <v-list dense>
                <v-list-item link @click="logout">
                    <v-list-item-action>
                        <v-icon>mdi-power</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="blue" dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title>Review & Rating App</v-toolbar-title>
        </v-app-bar>

        <v-content>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col class="text-center">
                        <template>
                            <v-card
                                class="mx-auto elevation-20"
                                color="#E9F1F1"
                                light
                                style="max-width: 700px;"
                            >
                                <v-row justify="space-between">
                                    <v-col cols="8" class="text-justify">
                                        <v-card-title primary-title>
                                            <div>
                                                <div
                                                    class="headline"
                                                    color="blue"
                                                >
                                                    We want to hear your
                                                    feedback!
                                                </div>
                                                <div>Food Delivery Service</div>
                                            </div>
                                        </v-card-title>
                                        <div class="pa-3">
                                            Lorem ipsum dolor sit amet
                                            consectetur adipisicing elit. Omnis
                                            sint odit harum atque quo eveniet
                                            pariatur corporis asperiores fugiat
                                            nam magnam
                                        </div>
                                    </v-col>
                                    <v-img
                                        class="shrink ma-2"
                                        contain
                                        height="200px"
                                        src="./img/delivery.png"
                                        style="flex-basis: 200px"
                                    ></v-img>
                                </v-row>
                                <v-divider light></v-divider>
                                <v-card-actions class="pa-4">
                                    <h5>Rate us</h5>
                                    <v-spacer></v-spacer>
                                    <span
                                        class="black--text text--lighten-2 caption mr-2"
                                        >({{ rating }})</span
                                    >
                                    <v-rating
                                        v-model="rating"
                                        background-color="grey"
                                        color="yellow accent-4"
                                        dense
                                        half-increments
                                        hover
                                        :readonly="read"
                                        size="30"
                                    ></v-rating>
                                </v-card-actions>
                            </v-card>

                            <!--my reviews-->
                            <v-card
                                class="mx-auto elevation-20"
                                color="#E9F1F1"
                                light
                                style="max-width: 700px;"
                            >
                                <template>
                                    <v-data-table
                                        :headers="headers"
                                        :items="items"
                                        sort-by="rating"
                                        class="elevation-1"
                                    >
                                        <template v-slot:top>
                                            <v-toolbar flat color="white">
                                                <v-toolbar-title
                                                    >My Review</v-toolbar-title
                                                >
                                                <v-divider
                                                    class="mx-4"
                                                    inset
                                                    vertical
                                                ></v-divider>
                                                <v-spacer></v-spacer>
                                                <v-dialog
                                                    v-model="dialog"
                                                    max-width="500px"
                                                >
                                                    <template
                                                        v-slot:activator="{
                                                            on
                                                        }"
                                                    >
                                                        <div
                                                            class="text-center"
                                                        >
                                                            <v-btn
                                                                rounded
                                                                color="primary"
                                                                dark
                                                                v-on="on"
                                                            >
                                                                <v-icon left
                                                                    >mdi-pencil</v-icon
                                                                >Post Review
                                                            </v-btn>
                                                        </div>
                                                    </template>

                                                    <!--modal-->
                                                    <v-card>
                                                        <v-card-title>
                                                            <span
                                                                class="headline"
                                                                >{{
                                                                    formTitle
                                                                }}</span
                                                            >
                                                        </v-card-title>

                                                        <v-card-text>
                                                            <v-container fluid>
                                                                <v-row>
                                                                    <v-col
                                                                        cols="12"
                                                                    >
                                                                        <v-textarea
                                                                            v-model="
                                                                                editedItem.review
                                                                            "
                                                                            label="Review"
                                                                            counter
                                                                            filled
                                                                            :rules="
                                                                                rules
                                                                            "
                                                                            :value="
                                                                                value
                                                                            "
                                                                            shaped
                                                                            height="30"
                                                                        ></v-textarea>
                                                                    </v-col>
                                                                    <v-col
                                                                        cols="12"
                                                                    >
                                                                        <span
                                                                            class="black--text text--lighten-2 caption mr-2"
                                                                            >Ratings:</span
                                                                        >
                                                                        <v-rating
                                                                            v-model="
                                                                                editedItem.rating
                                                                            "
                                                                            label="Rating"
                                                                            background-color="grey"
                                                                            color="yellow accent-4"
                                                                            dense
                                                                            half-increments
                                                                            hover
                                                                            size="30"
                                                                        ></v-rating>
                                                                    </v-col>
                                                                </v-row>
                                                            </v-container>
                                                        </v-card-text>

                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn
                                                                color="blue darken-1"
                                                                text
                                                                @click="close"
                                                                >Cancel</v-btn
                                                            >
                                                            <v-btn
                                                                color="blue darken-1"
                                                                text
                                                                @click="save"
                                                                >Save</v-btn
                                                            >
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-dialog>
                                            </v-toolbar>
                                        </template>
                                        <template v-slot:item.action="{ item }">
                                            <v-icon
                                                small
                                                class="mr-2"
                                                @click="editItem(item)"
                                                >mdi-pencil</v-icon
                                            >
                                            <v-icon
                                                small
                                                @click="deleteItem(item)"
                                                >mdi-trash-can-outline</v-icon
                                            >
                                        </template>
                                        <template v-slot:no-data>
                                            <v-btn
                                                color="primary"
                                                @click="initialize"
                                                >Reset</v-btn
                                            >
                                        </template>
                                    </v-data-table>
                                </template>
                            </v-card>
                        </template>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>

        <v-footer color="blue" app>
            <span class="white--text">CSP &copy; 2020</span>
        </v-footer>
    </v-app>
</template>

<script>
export default {
    props: {
        source: String
    },
    data: () => ({
        drawer: null,
        rating: 4.5,
        rules: [v => v.length <= 100 || "Max 25 characters"],
        value: "Write your review here...",
        read: true,

        dialog: false,
        headers: [
            {
                text: "Review",
                align: "left",
                sortable: false,
                value: "review"
            },
            { text: "Rating", value: "rating" },
            { text: "Actions", value: "action", sortable: false }
        ],
        items: [],
        editedIndex: -1,
        editedItem: {
            id:'',
            review: "",
            rating: 0
        },
        defaultItem: {
            review: "",
            rating: 0
        }
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Write a review" : "Edit Item";
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get("./api/reviews").then(res => {
                this.items = res.data;
                this.getAverage();
            });
        },

        editItem(item) {
            this.editedIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.items.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
                this.items.splice(index, 1) &&
                axios.delete("./api/reviews/" + item.id);

            this.getAverage();
        },

        getAverage() {
            this.rating =
                (this.items.reduce((i, j) => i + j.rating, 0) /
                this.items.length).toFixed(2);
        },

        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(
                        this.items[this.editedIndex],
                        this.editedItem
                    );

                axios.patch("./api/reviews/" + this.editedItem.id, this.editedItem).then(res => {
                    this.getAverage();
                    return res.data;
                });
            } else {
                axios.post("./api/reviews", this.editedItem).then(res => {
                    this.getAverage();
                    return res.data;
                });
                this.items.push(this.editedItem);
            }
            this.close();
        },

        logout() {
            axios.post("./logout").then(res => {
                window.location.href = "./";
            });
        }
    }
};
</script>
