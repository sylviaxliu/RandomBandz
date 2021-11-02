import Head from 'next/head';
import Link from 'next/link'
import Layout from '../components/layout'
import Search from "../components/searchBar"


export default function Home() {
  return (
    <Layout>
      <Head>
        <title>Random Bandz</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main>
        <h1 className="title">
          Welcome to Random Bandz!
        </h1>

        <Link href="/home">click to get started</Link>

      </main>

    </Layout>
  )
}
