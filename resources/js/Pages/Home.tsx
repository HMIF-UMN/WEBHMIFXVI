import { Head } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import HeroSection from '@/components/Home/Hero';
import AboutSection from '@/components/Home/About';
import PojokHMIFSection from '@/components/Home/PojokHMIF';
import ProkerSection from '@/components/Home/Proker';
import ContactUs from '@/components/Home/ContactUs';

export default function Home() {
    return (
        <AppLayout>
            <Head title="Home" />
            <HeroSection />
            <AboutSection />
            <PojokHMIFSection />
            <ProkerSection />
            <ContactUs />
        </AppLayout>
    );
}
