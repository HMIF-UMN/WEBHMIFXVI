"use client";

import React, { useState } from 'react';
import { motion, AnimatePresence, Variants } from 'framer-motion';
import { aboutUsData } from '@/components/AboutUs/datas/aboutUsData';
import { MaskImage, getTitleColor } from '@/components/AboutUs/datas/division';
import { kpiMembers } from '@/components/AboutUs/datas/kpiMembers';
import KpiHistoryModal from '@/components/AboutUs/KpiHistory';

const buttonImg = '/assets/AboutUs/assetDetailMembers/ButtonMore.svg';
const instagram = '/assets/AboutUs/assetDetailMembers/instagram.svg';
const linkedln = '/assets/AboutUs/assetDetailMembers/linkedln.svg';
const github = '/assets/AboutUs/assetDetailMembers/github.svg';

// Helper: rata-rata KPI seluruh anggota divisi (semua periode)
const getDivisionAverageKpi = (members: any[]) => {
    let totalScore = 0;
    let totalDataCount = 0;

    members.forEach((m) => {
        const memberData = kpiMembers[m.name as keyof typeof kpiMembers];
        if (memberData && memberData.history) {
            const values = Object.values(memberData.history);
            totalScore += values.reduce((sum, v) => sum + v, 0);
            totalDataCount += values.length;
        }
    });

    return totalDataCount === 0 ? 0 : Math.floor(totalScore / totalDataCount);
};

// Helper: rata-rata KPI satu anggota (semua periode)
const getMemberAverageKpi = (memberName: string): number => {
    const memberData = kpiMembers[memberName as keyof typeof kpiMembers];
    if (!memberData || !memberData.history) return 0;
    const values = Object.values(memberData.history);
    if (values.length === 0) return 0;
    return Math.floor(values.reduce((sum, v) => sum + v, 0) / values.length);
};

export default function DivisionSection() {
    const [activeIndex, setActiveIndex] = useState(3);
    const [showDetail, setShowDetail] = useState(false);
    const [activeMemberIndex, setActiveMemberIndex] = useState(0);
    const [isHistoryModalOpen, setIsHistoryModalOpen] = useState(false);

    const activeDivision = aboutUsData[activeIndex];
    const activeMember = activeDivision.members[activeMemberIndex];
    const hasMultipleMembers = activeDivision.members.length > 1;

    // ✅ Sekarang dihitung sebagai rata-rata dari semua periode, bukan .overall
    const activeMemberKpi = getMemberAverageKpi(activeMember.name);
    const displayKpi = getDivisionAverageKpi(activeDivision.members);

    const nextMember = () => {
        setActiveMemberIndex((prev) => (prev + 1) % activeDivision.members.length);
    };
    const prevMember = () => {
        setActiveMemberIndex((prev) => (prev - 1 + activeDivision.members.length) % activeDivision.members.length);
    };

    const bgVariants: Variants = {
        intro: { x: "0%", opacity: 0.4 },
        detail: { x: "15%", opacity: 0.1 }
    };
    const contentVariants: Variants = {
        hidden: { opacity: 0, y: 20, filter: "blur(5px)" },
        visible: {
            opacity: 1,
            y: 0,
            filter: "blur(0px)",
            transition: { duration: 0.5, ease: "easeOut", staggerChildren: 0.1 }
        },
        exit: {
            opacity: 0,
            y: -10,
            filter: "blur(5px)",
            transition: { duration: 0.3, ease: "easeIn" }
        }
    };

    return (
        <section className="relative w-full min-h-screen bg-[#060C17] flex flex-col overflow-hidden">

            {/* MASKS DIVISI */}
            <div className="absolute top-0 left-0 w-full z-40">
                <div className="flex flex-wrap w-full pointer-events-auto">
                    {aboutUsData.map((div, i) => {
                        const isActive = i === activeIndex;
                        const widthClass = "w-[25%] md:w-[14.2857%]";

                        return (
                            <button
                                key={i}
                                onClick={() => {
                                    if (activeIndex !== i) {
                                        setActiveIndex(i);
                                        setShowDetail(false);
                                        setActiveMemberIndex(0);
                                    }
                                }}
                                className={`relative aspect-square transition-all duration-300 ease-in-out ${widthClass} ${isActive ? 'z-20 drop-shadow-[0_0_3px_rgba(255,255,255,1)] opacity-100' : 'z-10 opacity-100 hover:brightness-110'}`}
                            >
                                <img src={MaskImage(div.singkatan)} alt={div.singkatan} className="absolute inset-0 w-full h-full object-cover object-top" />
                            </button>
                        );
                    })}
                    <div className="relative aspect-square w-[25%] md:hidden z-10 opacity-100 pointer-events-none">
                        <img src={MaskImage("Blank")} alt="Blank Mask" className="absolute inset-0 w-full h-full object-cover object-top" />
                    </div>
                </div>
            </div>

            {/* BACKGROUND IMG */}
            <motion.div
                className="absolute inset-0 z-0 pointer-events-none overflow-hidden"
                variants={bgVariants}
                initial="intro"
                animate={showDetail ? "detail" : "intro"}
                transition={{ duration: 1, ease: [0.25, 1, 0.5, 1] }}
            >
                {activeDivision.image && (
                    <img src={activeDivision.image} alt={activeDivision.name} className="absolute inset-0 w-full h-full object-cover object-right grayscale mix-blend-luminosity" />
                )}
                <div className="absolute inset-0 bg-gradient-to-r from-[#060C17] via-[#060C17]/95 to-[#060C17]/10" />
                <div className="absolute inset-0 bg-gradient-to-t from-[#060C17] via-transparent to-transparent" />
            </motion.div>

            {/* CONTENT AREA */}
            <div className="relative z-10 grow w-full max-w-[90rem] mx-auto px-6 sm:px-10 md:px-24 h-full flex flex-col justify-center pt-[60vw] sm:pt-[45vw] md:pt-[20vw] lg:pt-48 pb-12 lg:pb-20">
                <AnimatePresence mode="wait">

                    {!showDetail ? (
                        <motion.div
                            key="intro"
                            variants={contentVariants}
                            initial="hidden"
                            animate="visible"
                            exit="exit"
                            className="flex flex-col lg:grid lg:grid-cols-12 gap-6 lg:gap-12 w-full h-full lg:items-end"
                        >
                            <motion.div variants={contentVariants} className="lg:col-span-8 flex flex-col items-start justify-end order-1 lg:order-1 pt-4">
                                <motion.h3 variants={contentVariants} className="text-white font-['Kanit'] font-semibold text-2xl sm:text-3xl md:text-4xl tracking-[-0.03em] leading-none mb-1">
                                    Introducing
                                </motion.h3>

                                <motion.h1
                                    variants={contentVariants}
                                    className="font-['Kanit'] font-semibold text-5xl sm:text-6xl md:text-7xl lg:text-[6rem] tracking-[-0.05em] leading-[0.85] uppercase mb-4 drop-shadow-xl w-full"
                                    style={{ color: getTitleColor(activeDivision.singkatan) }}
                                >
                                    {activeDivision.name}
                                </motion.h1>

                                <motion.p variants={contentVariants} className="text-[#C2CAD6] font-['Work_Sans'] text-[10px] sm:text-xs md:text-sm lg:text-[15px] mb-8 lg:mb-12 uppercase tracking-[0.15em] leading-relaxed max-w-3xl">
                                    {activeDivision.members.map((m: any) => m.name).join(" • ")}
                                </motion.p>

                                <motion.button
                                    variants={contentVariants}
                                    onClick={() => setShowDetail(true)}
                                    whileHover={{ scale: 1.05, opacity: 1 }}
                                    whileTap={{ scale: 0.95 }}
                                    className="hidden lg:block opacity-90 hover:opacity-100 cursor-pointer transition-opacity"
                                >
                                    <img src={buttonImg} alt="Get to Know More" className="w-[180px] lg:w-[220px] h-auto object-contain" />
                                </motion.button>
                            </motion.div>

                            <motion.div variants={contentVariants} className="lg:col-span-4 flex flex-col items-start lg:items-end text-left lg:text-right order-2 lg:order-2 mt-4 lg:mt-0 lg:pb-6">
                                <p className="text-slate-400 font-['Work_Sans'] text-xs sm:text-sm md:text-base font-normal leading-normal mb-0 md:mb-1">
                                    With this month of
                                </p>

                                <h2 className="text-white font-['Kanit'] font-semibold text-5xl sm:text-6xl md:text-7xl lg:text-[6rem] leading-[0.9] tracking-[-0.05em] drop-shadow-lg my-1">
                                    {displayKpi.toLocaleString('id-ID')}
                                </h2>

                                <p className="text-slate-400 font-['Work_Sans'] text-[10px] sm:text-xs md:text-sm mt-1 md:mt-2 mb-2 lg:mb-4">
                                    average key performance indicator
                                </p>

                                <button
                                    onClick={() => setIsHistoryModalOpen(true)}
                                    className="text-slate-500 font-['Work_Sans'] text-xs md:text-sm underline underline-offset-4 hover:text-white transition-colors cursor-pointer"
                                >
                                    View History
                                </button>

                                <motion.button
                                    variants={contentVariants}
                                    onClick={() => setShowDetail(true)}
                                    whileHover={{ scale: 1.05, opacity: 1 }}
                                    whileTap={{ scale: 0.95 }}
                                    className="mt-10 opacity-90 cursor-pointer lg:hidden transition-all duration-300"
                                >
                                    <img src={buttonImg} alt="Get to Know More" className="w-[180px] h-auto object-contain" />
                                </motion.button>
                            </motion.div>
                        </motion.div>

                    ) : (
                        // CAROUSEL
                        <motion.div
                            key="detail"
                            variants={contentVariants}
                            initial="hidden"
                            animate="visible"
                            exit="exit"
                            className="flex flex-col lg:grid lg:grid-cols-12 gap-8 w-full h-full lg:items-center relative pt-10"
                        >
                            {/* KIRI: IMAGE */}
                            <div className="lg:col-span-6 flex justify-center items-center relative min-h-[50vh] lg:min-h-[70vh]">
                                <div className="relative w-[70%] max-w-[280px] sm:max-w-[320px] lg:max-w-[380px] aspect-[3/4]">

                                    {hasMultipleMembers && (
                                        <>
                                            <div className="absolute -top-6 -right-12 md:-top-12 md:-right-24 w-[60%] md:w-[70%] aspect-[3/4] z-0 opacity-40 brightness-50">
                                                <img
                                                    src={activeDivision.members[(activeMemberIndex + 1) % activeDivision.members.length]?.image || activeDivision.image}
                                                    alt="Next Member"
                                                    className="absolute inset-0 w-full h-full object-cover rounded-md"
                                                />
                                            </div>

                                            <div className="absolute -bottom-8 -right-8 md:-bottom-16 md:-right-12 w-[50%] md:w-[60%] aspect-[3/4] z-0 opacity-30 brightness-50">
                                                <img
                                                    src={activeDivision.members[(activeMemberIndex + 2) % activeDivision.members.length]?.image || activeDivision.image}
                                                    alt="Next Next Member"
                                                    className="absolute inset-0 w-full h-full object-cover rounded-md"
                                                />
                                            </div>
                                        </>
                                    )}

                                    {/* MAIN IMG */}
                                    <AnimatePresence mode="popLayout">
                                        <motion.div
                                            key={activeMemberIndex}
                                            initial={{ opacity: 0, scale: 0.95, x: -20 }}
                                            animate={{ opacity: 1, scale: 1, x: 0 }}
                                            exit={{ opacity: 0, scale: 0.95, x: 20 }}
                                            transition={{ duration: 0.4 }}
                                            className="absolute inset-0 z-10 drop-shadow-2xl rounded-sm overflow-hidden bg-slate-800"
                                        >
                                            {activeMember.image ? (
                                                <img src={activeMember.image} alt={activeMember.name} className="absolute inset-0 w-full h-full object-cover" />
                                            ) : (
                                                <div className="w-full h-full flex items-center justify-center text-slate-500">No Image</div>
                                            )}
                                        </motion.div>
                                    </AnimatePresence>

                                    {/* SVG Mask */}
                                    <div className="absolute -left-10 -bottom-8 md:-left-16 md:-bottom-12 w-[120px] h-[120px] md:w-[180px] md:h-[180px] z-20 drop-shadow-xl">
                                        <img src={MaskImage(activeDivision.singkatan)} alt="Mask" className="absolute inset-0 w-full h-full object-contain" />
                                    </div>

                                    {/* KPI — rata-rata member aktif */}
                                    <div className="absolute -right-12 -bottom-4 md:-right-24 md:-bottom-6 z-20 text-right">
                                        <h2 className="font-['Kanit'] font-bold text-5xl md:text-7xl text-white leading-none drop-shadow-lg">
                                            {(activeMemberKpi > 0 ? activeMemberKpi : displayKpi).toLocaleString('id-ID')}
                                        </h2>
                                        <p className="font-['Work_Sans'] text-[10px] md:text-xs text-slate-300 mt-1">Key Performance Indicator</p>

                                        <button
                                            onClick={() => setIsHistoryModalOpen(true)}
                                            className="font-['Work_Sans'] text-slate-400 hover:text-white text-[10px] md:text-xs underline underline-offset-2 mt-1 transition-colors cursor-pointer"
                                        >
                                            View History
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {/* KANAN: TEXT & TOMBOL */}
                            <div className="lg:col-span-6 flex flex-col items-center justify-center text-center relative z-20 mt-12 lg:mt-0">
                                <button
                                    onClick={() => setShowDetail(false)}
                                    className="text-slate-400 hover:text-white underline underline-offset-4 font-['Work_Sans'] text-xs md:text-sm transition-colors mb-8 md:mb-12 cursor-pointer"
                                >
                                    Kembali
                                </button>

                                {hasMultipleMembers ? (
                                    <button onClick={prevMember} className="opacity-60 hover:opacity-100 transition-opacity mb-4 cursor-pointer">
                                        <img src="/assets/AboutUs/assetDetailMembers/FrameUp.svg" alt="Up" className="w-[32px] h-[32px]" />
                                    </button>
                                ) : (
                                    <div className="h-[32px] w-[32px] mb-4"></div>
                                )}

                                <div className="min-h-[200px] md:min-h-[220px] flex flex-col items-center justify-center w-full">
                                    <AnimatePresence mode="wait">
                                        <motion.div
                                            key={activeMemberIndex}
                                            initial={{ opacity: 0, y: 10 }}
                                            animate={{ opacity: 1, y: 0 }}
                                            exit={{ opacity: 0, y: -10 }}
                                            transition={{ duration: 0.3 }}
                                            className="flex flex-col items-center max-w-sm px-4"
                                        >
                                            <p className="text-slate-400 uppercase tracking-[0.2em] font-['Work_Sans'] text-[10px] md:text-xs font-semibold mb-2">
                                                {activeMember.position || "MEMBER"}
                                            </p>
                                            <h2 className="text-white font-['Kanit'] font-semibold text-3xl md:text-5xl leading-[1.1] mb-6">
                                                {activeMember.name}
                                            </h2>

                                            <p className="text-slate-300 font-['Work_Sans'] text-xs md:text-sm italic leading-relaxed min-h-[40px]">
                                                {activeMember.quote ? `"${activeMember.quote}"` : " "}
                                            </p>
                                        </motion.div>
                                    </AnimatePresence>
                                </div>

                                {/* Sosmed */}
                                <div className="flex gap-6 mt-4 mb-6 items-center justify-center">
                                    {activeMember.instagram ? (
                                        <a href={activeMember.instagram} target="_blank" rel="noopener noreferrer">
                                            <img src={instagram} alt="Instagram" className="w-[22px] h-[22px] opacity-60 hover:opacity-100 cursor-pointer transition-opacity" />
                                        </a>
                                    ) : (
                                        <div className="w-[22px] h-[22px] opacity-20"><img src={instagram} alt="Instagram" className="w-full h-full" /></div>
                                    )}

                                    {activeMember.linkedin ? (
                                        <a href={activeMember.linkedin} target="_blank" rel="noopener noreferrer">
                                            <img src={linkedln} alt="LinkedIn" className="w-[22px] h-[22px] opacity-60 hover:opacity-100 cursor-pointer transition-opacity" />
                                        </a>
                                    ) : (
                                        <div className="w-[22px] h-[22px] opacity-20"><img src={linkedln} alt="LinkedIn" className="w-full h-full" /></div>
                                    )}

                                    {activeMember.github ? (
                                        <a href={activeMember.github} target="_blank" rel="noopener noreferrer">
                                            <img src={github} alt="Github" className="w-[22px] h-[22px] opacity-60 hover:opacity-100 cursor-pointer transition-opacity" />
                                        </a>
                                    ) : (
                                        <div className="w-[22px] h-[22px] opacity-20"><img src={github} alt="Github" className="w-full h-full" /></div>
                                    )}
                                </div>

                                {hasMultipleMembers ? (
                                    <button onClick={nextMember} className="opacity-60 hover:opacity-100 transition-opacity cursor-pointer">
                                        <img src="/assets/AboutUs/assetDetailMembers/FrameDown.svg" alt="Down" className="w-[32px] h-[32px]" />
                                    </button>
                                ) : (
                                    <div className="h-[32px] w-[32px]"></div>
                                )}
                            </div>
                        </motion.div>
                    )}
                </AnimatePresence>
            </div>

            {/* MODAL HISTORY */}
            <KpiHistoryModal
                isOpen={isHistoryModalOpen}
                onClose={() => setIsHistoryModalOpen(false)}
                activeDivision={activeDivision}
            />

        </section>
    );
}