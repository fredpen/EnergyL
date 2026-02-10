import FLink from "../../component/flink.tsx";
import FLogo from "../../component/flogo.tsx";
import {useState} from "react";
import useApi from "../../composables/useApi.ts";

export default function Login() {

    const [email, setEmail] = useState<string>();
    const [password, setPassword] = useState<string>();

    const signIn = async () => {
        console.log('fred')
        const res = await useApi.req('/login', 'POST', {email, password});
        console.log(res);

    }

    return <>
        <section className="bg-gray-50">
            <div className="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <FLogo/>
                <div
                    className="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div className="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 className="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                            Sign in
                        </h1>
                        <form className="space-y-4 md:space-y-6">
                            <div>
                                <label htmlFor="email"
                                       className="block mb-2 text-sm font-medium text-gray-900 ">Your
                                    email</label>
                                <input value={email} onChange={() => setEmail} type="email" name="email" id="email"
                                       className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                       placeholder="name@company.com"/>
                            </div>
                            <div>
                                <label htmlFor="password"
                                       className="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                                <input value={password} onChange={() => setPassword} type="password" name="password"
                                       id="password" placeholder="••••••••"
                                       className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                />
                            </div>
                            <div className="flex items-center justify-between">
                                <div className="flex items-start">
                                    <div className="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox"
                                               className="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                        />
                                    </div>
                                    <div className="ml-3 text-sm">
                                        <label htmlFor="remember" className="text-gray-500 dark:text-gray-300">Remember
                                            me</label>
                                    </div>
                                </div>
                                <FLink href={'/'} text="Forgot password?"/>
                            </div>


                            <button className="btn btn-primary">Primary</button>
                            <button onClick={() => signIn()} type="button"
                                    className="w-full text-white bg-black box-border border border-transparent hover:bg-dark-strong focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Dark
                            </button>


                            <p className="text-sm font-light text-gray-500">
                                Don’t have an account yet?
                                <FLink href={'/register'} text="Sign up"/>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </>
}
