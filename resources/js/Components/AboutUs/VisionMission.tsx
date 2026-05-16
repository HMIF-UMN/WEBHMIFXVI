import { motion, Variants } from 'framer-motion';

export default function VisionMission() {
    const slideInLeft: Variants = { hidden: { opacity: 0, x: -50 }, visible: { opacity: 1, x: 0, transition: { duration: 0.8, ease: 'easeOut' } } };
    const slideInRight: Variants = { hidden: { opacity: 0, x: 50 }, visible: { opacity: 1, x: 0, transition: { duration: 0.8, ease: 'easeOut' } } };

    return (
        <section className="relative z-10 w-full max-w-[75rem] mx-auto px-6 py-10 flex flex-col gap-12 md:gap-20 mb-24 overflow-hidden">
            <div className="flex flex-col md:grid md:grid-cols-2 gap-6 items-end">
                <motion.div className="w-full flex flex-col items-start z-10" initial="hidden" whileInView="visible" viewport={{ once: true, amount: 0.3 }} variants={slideInLeft}>
                    <h2 className="text-[3rem] md:text-[4rem] font-bold tracking-tight mb-2 md:mb-4 bg-gradient-to-r from-[#00A8E8] to-[#005696] bg-clip-text text-transparent">Vision</h2>
                    <div className="bg-[#060C17] border border-[#1E2C41] rounded-[20px] p-6 md:p-8 w-full">
                        <p className="text-[#C2CAD6] text-sm md:text-[18px] leading-[1.6]" style={{ fontFamily: 'var(--font-work-sans)' }}>
                            To establish HMIF UMN as an innovative and creative hub, serve as a role model for students, and foster an informatics ecosystem driven by tangible achievements and real-world contributions.
                        </p>
                    </div>
                </motion.div>
                <motion.div className="hidden md:flex justify-start relative w-full" initial="hidden" whileInView="visible" viewport={{ once: true, amount: 0.3 }} variants={slideInRight}>
                    <div className="relative w-full" style={{ aspectRatio: '2.5/1' }}>
                        <img src="/assets/AboutUs/VisiMisi/FrameRight.svg" alt="" className="w-full h-full object-contain object-bottom" />
                    </div>
                </motion.div>
            </div>

            <div className="flex flex-col md:grid md:grid-cols-2 gap-6 items-center mt-8">
                <motion.div className="hidden md:flex justify-end relative w-full order-2 md:order-1" initial="hidden" whileInView="visible" viewport={{ once: true, amount: 0.3 }} variants={slideInLeft}>
                    <div className="relative w-full" style={{ aspectRatio: '2.5/1' }}>
                        <img src="/assets/AboutUs/VisiMisi/FrameLeft.svg" alt="" className="w-full h-full object-contain" />
                    </div>
                </motion.div>
                <motion.div className="w-full flex flex-col items-start z-10 order-1 md:order-2" initial="hidden" whileInView="visible" viewport={{ once: true, amount: 0.3 }} variants={slideInRight}>
                    <h2 className="text-[3rem] md:text-[4rem] font-bold tracking-tight mb-2 md:mb-4 bg-gradient-to-r from-[#00A8E8] to-[#005696] bg-clip-text text-transparent">Mission</h2>
                    <div className="bg-[#060C17] border border-[#1E2C41] rounded-[20px] p-6 md:p-8 w-full">
                        <ul data-lenis-prevent="true" className="text-[#C2CAD6] text-sm md:text-[16px] leading-[1.6] list-disc list-inside md:list-outside pl-2 md:pl-8 space-y-3 overflow-y-auto h-[13.75rem] pr-6 custom-scrollbar pointer-events-auto overscroll-contain" style={{ fontFamily: 'var(--font-work-sans)' }}>
                            <li>To embrace the responsibility of enhancing the academic environment and overall well-being of all UMN Informatics students.</li>
                            <li>To serve as a synergistic communication bridge connecting Informatics students, faculty members, alumni, and external partners.</li>
                            <li>To develop relevant and sustainable programs focused on improving academic and professional skills.</li>
                            <li>To build a strong and supportive community culture where every member feels welcomed and supported.</li>
                        </ul>
                    </div>
                </motion.div>
            </div>
        </section>
    );
}
