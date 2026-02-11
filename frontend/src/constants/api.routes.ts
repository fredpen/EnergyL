export const API_BASE_URL: string = 'http://127.0.0.1:8000/api/v1/';

export const storageKeys = {
   sessionToken: 'sessionToken',
   activeSite: 'activeSite',
   customerName: 'customerName',
}

export const API_ROUTES = {
   auth: {
      login: 'auth/login',
      register: 'auth/register',
   },
   site: {
      store: 'site',
      mySites: 'site',
      siteDetails: (siteId: string) => `site/${siteId}`,
   },
   contact: {
      get: 'contact-details',
      set: 'contact-details'
   },
   billing: {
      get: 'billing-preference',
      set: 'billing-preference'
   },

}
