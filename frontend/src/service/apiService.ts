import useApi from "../composables/useApi.ts";
import {API_ROUTES} from "../constants/api.routes.ts";
import {ISite} from "../types/site.ts";

export class ApiService {
   static async login(email: string, password: string) {
      return await useApi.req(
         API_ROUTES.auth.login,
         'POST',
         {email, password}
      );
   }

   static async getSites(): Promise<ISite[]> {
      const res: any = await useApi.req(
         API_ROUTES.site.mySites,
         'GET'
      );

      return res.data.data;
   }
}
