export  const _query = {
    exec: async function(url: string, data:any = null, params = {}) {
        params = {
            ... {
                method: 'GET',
                headers: {
                    "Accept": "application/json, text/javascript, */*; q=0.01",
                    "X-Requested-With": "XMLHttpRequest"
                }
            },
            ...params
        }
        if (data) {
            params = {
                ...params,
                ... { body: data }
            }
        }

        const response = await fetch(url, params);
        return response.json();
    },
    get: async function(url: string, params = {}) {
        return this.exec(url, null, params)
    },
    post: async function(url: string, data:any = null, params = {}) {
        params = {...params, ... { method: "POST" } }
        return this.exec(url, data, params)
    },
}