<template>
    <div>
        <div class="flex items-center justify-center h-screen bg-gradient-to-r from-pink-200 via-purple-200 to-blue-200 p-8">
            <form @submit.prevent="submitForm()">
                <p class="text-center text-2xl font-bold">Sign Up</p>
                <div class="bg-black bg-opacity-10 p-10 rounded-3xl text-black shadow-2xl shadow-violet-700 space-y-6">
                    <div>
                        <label for="name">Name</label>
                        <div>
                            <input class="rounded p-1 text-violet-800 font-semibold" type="text" name="name" placeholder="name" v-model="state.user.name">
                            <p class="text-red-700">
                                {{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0] }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <label for="email_address">Email Address</label>
                        <div>
                            <input class="rounded p-1 text-violet-800 font-semibold" type="email" name="email" placeholder="email address" v-model="state.user.email">
                            <p class="text-red-700">
                                {{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0] }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <div>
                            <input class="rounded p-1 text-violet-800 font-semibold" type="password" name="password" placeholder="password" v-model="state.user.password">
                            <p class="text-red-700">
                                {{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.password && state.errors._data.errors.password[0] }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" @click="goBack">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                </div>
                <div class="mt-5 flex justify-center underline" >
                    <button type="button" @click="goToLogin">Already have an Account?</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
const state = reactive({
    errors: null,
    isPageLoading: false,
    user: {
        name: null,
        email: null,
        password: null,
    }
})

async function submitForm(){
    const params = {
        name: state.user.name,
        email: state.user.email,
        password: state.user.password,
    } 
    try {
        const response = await $fetch (`http://127.0.0.1:8000/api/auth/register`, {
            method: 'POST',
            body: params
        })

        if (response.data) {
            localStorage.setItem('_token', response.data.token)
            navigateTo('/login')
        }
    } catch (error) {
        state.errors = error.response
        console.log('error', error)
    }
}

function goBack() {
  console.log('Going back...');
  navigateTo('/');
}

function goToLogin() {
  navigateTo('/login');
}
</script>

<style scoped>

</style> 