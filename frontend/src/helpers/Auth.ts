import {storageKeys} from "../constants/api.routes.ts";

export class Auth {
   static isAuthenticated = () => {
      //More checks should be implemented here like token refresh
      // at minimum a token time validity check to a day or so
      return !!localStorage.getItem(storageKeys.sessionToken);
   }

   static signOut = () => {
      //This should also make calls to the backend to revoke the token
      localStorage.removeItem(storageKeys.activeSite);
      localStorage.removeItem(storageKeys.customerName);
      localStorage.removeItem(storageKeys.sessionToken);
   }
}
