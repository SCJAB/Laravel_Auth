    <template>
        <div class="h-screen bg-gradient-to-r from-purple-100 via-pink-100 to-blue-100">
        <div class="w-full flex justify-center">
            <table v-if="state.user" class="w-9/12 border-collapse mt-4">
            <thead>
            <tr class="bg-slate-900 border text-white">
                <th class="border-slate-900 border px-4 py-2">Name</th>
                <th class="border-slate-900 border px-4 py-2">Email</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in state.user" :key="user.id" class="border">
                <td class="border-slate-900 border px-4 py-2">{{ user.name }}</td>
                <td class="border-slate-900 border px-4 py-2">{{ user.email }}</td>
            </tr>
            </tbody>
        </table>
        </div>
        <div v-if="state.user" class="w-9/12 mx-48 mt-5">
            <button type="button" @click="goBack">Back</button>
        </div>
        </div>
    </template>

    <script setup>
    const state = reactive({
        user: null,
    })

    onMounted(() => {
        fetchUser()
    })

    onBeforeRouteLeave((to, from, next) => {
    if (state.user) {
        logout();
    }
    next()
    })

    async function fetchUser() {
        try {
            const response = await $fetch (`http://127.0.0.1:8000/api/user`, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('_token')
                }
            })

            if (response.data) {
                state.user = response.data
            }
        } catch (error) {
            state.errors = error.response
            console.log('Error fetching users', error)
        }
    }

    function logout() {
    localStorage.removeItem('_token')
    state.user = null
    }

    function goBack() {
    console.log('Going back...');
    navigateTo('/login');
    }
    </script>

    <style scoped>

    </style> 