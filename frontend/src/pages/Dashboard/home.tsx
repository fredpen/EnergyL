import MonthlyReadingChart from "../../components/Site/MonthlyReadingChart.tsx";
import StatisticsChart from "../../components/Site/StatisticsChart";
import MonthlyTarget from "../../components/Site/MonthlyTarget";
import RecentOrders from "../../components/Site/RecentOrders";
import DemographicCard from "../../components/Site/DemographicCard";
import SiteMetrics from "../../components/Site/SiteMetrics.tsx";

export default function Home() {
   return (
      <>
         <div className="grid grid-cols-12 gap-4 md:gap-6">
            <div className="col-span-12 space-y-6 xl:col-span-7">
               <SiteMetrics/>
            </div>

            <div className="col-span-12 xl:col-span-5">
               <MonthlyTarget/>
            </div>

            <div className="col-span-12">
               <MonthlyReadingChart/>
            </div>

            <div className="col-span-12">
               <StatisticsChart/>
            </div>

            <div className="col-span-12 xl:col-span-5">
               <DemographicCard/>
            </div>

            <div className="col-span-12 xl:col-span-7">
               <RecentOrders/>
            </div>
         </div>
      </>
   );
}
