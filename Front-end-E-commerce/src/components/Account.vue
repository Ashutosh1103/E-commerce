<template>
  <section id="cart_items">
    <div class="container">
      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-5">
            <div class="shopper-info">
              <p>Personal info</p>
              <div v-if="this.msg">
                <div class="alert alert-success">{{ this.msg }}</div>
              </div>
              <form @submit.prevent="update()">
                <input
                  type="text"
                  placeholder="Email"
                  v-model="user.email"
                  readonly
                  name="last_name"
                />
                <input
                  type="text"
                  placeholder="Firstname"
                  v-model="user.first_name"
                  name="first_name"
                  required
                />
                <input
                  type="text"
                  placeholder="Lastname"
                  v-model="user.last_name"
                  name="last_name"
                  required
                />
                <button class="btn btn-primary" type="submit">Submit</button>
              </form>
            </div>
          </div>
          <div class="col-sm-5 clearfix">
            <div class="bill-to">
              <p>Change Password</p>
              <div class="form-one">
                <form @submit.prevent="change()">
                  <input
                    type="text"
                    placeholder="Old password"
                    v-model="user1.oldpassword"
                    name="oldpassword"
                  />
                  <input
                    type="text"
                    placeholder="New password"
                    v-model="user1.newpassword"
                    name="newpassword"
                  />
                  <input
                    type="text"
                    placeholder="Confirm password"
                    name="confirmpassword"
                    v-model="user1.confirmpassword"
                  />
                  <button class="btn btn-primary" type="submit">
                    Change password
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/#cart_items-->
</template>
<script>
import { userDetails } from "@/common/Service.js";
import { updateUser } from "@/common/Service.js";
import { changePassword } from "@/common/Service.js";
export default {
  name: "Account",
  data() {
    return {
      userid: localStorage.getItem("uid"),
      user: {},
      user1: {
        oldpassword: "",
        newpassword: "",
        confirmpassword: "",
      },
      msg: null,
      submitted: false,
    };
  },
  methods: {
    getDetails() {
      userDetails(this.userid).then((res) => {
        this.user = res.data.details;
        console.log(this.user);
      });
    },
    update() {
      this.submitted = true;
      updateUser(this.userid, this.user)
        .then((res) => {
          console.log(res.data);
          this.msg = res.data.user;
        })
        .catch((err) => {
          console.log(err);
          this.msg = "not updated";
        });
    },
    change() {
      let formData = {
        newpassword: this.user1.newpassword,
        oldpassword: this.user1.oldpassword,
        confirmpassword: this.user1.confirmpassword,
      };
      changePassword(this.userid, formData)
        .then((res) => {
          console.log(res.data);
          alert('Password changed successfully')
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.getDetails();
  },
};
</script>

<style>
.clearfix {
  margin-bottom: 50px;
  padding-left: 80px;
}
.row {
  display: flex;
  justify-content: center;
}
</style>
