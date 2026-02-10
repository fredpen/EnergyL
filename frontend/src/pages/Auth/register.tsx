import {Link} from 'react-router-dom';
import FLogo from "../../component/flogo.tsx";

export default function Register() {
    return (
        <div className="p-5 max-w-[500px] mx-auto">
            <div className="flex flex-col items-center justify-center px-6  mx-auto md:h-screen lg:py-0">
                <FLogo/>

                <div className={'w-full'}>
                    <h1 className="text-2xl font-bold mb-4">Register</h1>
                    <form className="space-y-4">
                        <div>
                            <label htmlFor="email"
                                   className="block mb-2 text-sm font-medium text-gray-900 ">Your
                                email</label>
                            <input type="email" name="email" id="email"
                                   className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                   placeholder="name@company.com"/>
                        </div>
                        <div>
                            <label htmlFor="password"
                                   className="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                   className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            />
                        </div>
                    </form>
                    <p className="mt-4 text-sm">
                        Already have an account? <Link to="/login" className="text-blue-500">Login</Link>
                    </p>
                </div>
            </div>
        </div>
    );
}
