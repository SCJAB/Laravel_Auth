<template>
    <div>
        <div class="flex items-center justify-center h-screen bg-gradient-to-r from-pink-200 via-slate-400 to-blue-200 p-8">
            <div class="grid space-y-6">
                <button class="bg-black bg-opacity-10 py-2 px-6 rounded-xl text-xl font-semibold text-white hover:shadow-2xl shadow-slate-900 hover:scale-110" @click="goToLogin">Login</button>
                <button class="bg-black bg-opacity-10 py-2 px-6 rounded-xl text-xl font-semibold text-white hover:shadow-2xl shadow-slate-900 hover:scale-110" @click="goToSignUp">Sign Up</button> 
            </div>   
        </div>
    </div>
</template>

<script setup>
const router = useRouter()

const goToLogin = () => {
  router.push('/login')
}

const goToSignUp = () => {
  router.push('/register')
}
</script>

<style scoped>

</style> 